<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


use App\Model\UsersRepository;
use Nette\Application\UI\Form;
use Nette\Security\Passwords;
use Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation;
use Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Localization\SimpleTranslator;

final class UsersPresenter extends BasePresenter
{


    public function renderDefault()
    {
    }

    public function renderAdd()
    {
    }

    public function actionEdit($id)
    {
        $user = $this->users
            ->getUserById($id);

        if (!$user) {
            $this->error('Uživatel nenalezen!');
        }

        $articleArray = $user->toArray();
        $defaults = array_replace($articleArray);

        $this->getComponent('usersForm')
            ->setDefaults($defaults);
    }

    public function actionDelete($id){
        try {
            $this->users->deleteUser($id);
            $this->flashMessage('Článek byl úspěšně smazán','success');
        } catch (Exception $e) {
            $this->flashMessage($e->getMessage(), 'warning');
        }
        $this->redirect('default');
    }


    protected function createComponentUsersForm()
    {
        $presenter = $this->getAction();
        $caption = $presenter == 'add' ? 'Vytvořit' : 'Upravit';
        $roles = ['admin' => 'Administrátor', 'user' =>'Uživatel', 'librarius' => 'Librarius'];

        $form = new Form;
        $form->addText(UsersRepository::PRIMARY_TABLE_EMAIL,'E-mail')
        ->setRequired();
        $form->addText(UsersRepository::PRIMARY_TABLE_USERNAME,'Přihlašovací jméno',)
            ->setRequired();
        $form->addPassword(UsersRepository::PRIMARY_TABLE_PASSWORD,'Heslo')
            ->setRequired();
        $form->addRadioList(UsersRepository::PRIMARY_TABLE_ROLE,'Role',$roles)
            ->setRequired();

        $form->addSubmit('send',$caption)
            ->setHtmlAttribute('id','send');
        $form->onSuccess[] = [$this,'usersFormValidate'];

        return $form;
    }


    public function usersFormValidate($form,$data)
    {
        $emailExists = $this->users->userEmailExists($data->email);
        $usernameExists = $this->users->userUsernameExists($data->username);

        $userId = $this->getParameter('id');

        if ($userId){
            $this->usersFormSucceeded($data);
        }else
        {
            if ($emailExists)
            {
                $this->flashMessage('Uživatel se stejným emailem už existuje', 'warning');
                $this->redirect('Users:add');
            } elseif($usernameExists)
            {
                $this->flashMessage('Uživatel se stejnou přezdívkou už existuje', 'warning');
                $this->redirect('Users:add');
            } elseif (!$usernameExists && !$emailExists)
            {
                $this->usersFormSucceeded($data);
            }
        }
    }

    public function usersFormSucceeded($data)
    {
        $userId = $this->getParameter('id');

        $unhashedPassword = $data['password'];
        $hashedPassword = $this->passwords->hash($unhashedPassword);
        [$data['password'] = $hashedPassword];


        if ($userId) {
            $this->users
                ->updateUser($userId,$data);
            $this->flashMessage('Uživatel byl upraven', 'success');

        } else
        {
            $this->users
                ->insertUser($data);
            $this->flashMessage('Uživatel byl přidán', 'success');
            $this->redirect('Users:default');

        }
    }


    public function createComponentGrid($name): DataGrid
    {
        $grid = new DataGrid($this, $name);
        $selection = $this->users->findAll();

        $grid->setDataSource($selection);
        $grid->setTemplateFile(__DIR__.'/../../../Components/DataGrid/DataGrid.latte');
        $grid->setCustomPaginatorTemplate(__DIR__.'/../../../Components/DataGrid/DataGridPaginator.latte');

        $translator = new SimpleTranslator([
            'ublaboo_datagrid.no_item_found_reset' => 'Žádné položky nenalezeny. Filtr můžete vynulovat',
            'ublaboo_datagrid.no_item_found' => 'Žádné položky nenalezeny.',
            'ublaboo_datagrid.here' => 'zde',
            'ublaboo_datagrid.items' => 'Položky',
            'ublaboo_datagrid.all' => 'všechny',
            'ublaboo_datagrid.from' => 'z',
            'ublaboo_datagrid.reset_filter' => 'Resetovat filtr',
            'ublaboo_datagrid.group_actions' => 'Hromadné akce',
            'ublaboo_datagrid.show_all_columns' => 'Zobrazit všechny sloupce',
            'ublaboo_datagrid.hide_column' => 'Skrýt sloupec',
            'ublaboo_datagrid.action' => 'Akce',
            'ublaboo_datagrid.previous' => 'Předchozí',
            'ublaboo_datagrid.next' => 'Další',
            'ublaboo_datagrid.choose' => 'Vyberte',
            'ublaboo_datagrid.execute' => 'Provést',

            'Name' => 'Jméno',
            'Inserted' => 'Vloženo'
        ]);

        $grid->setTranslator($translator);

        $grid->addColumnText('username', 'Jméno')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('email', 'Email')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('role', 'Role')
            ->setSortable();

        $grid->addAction('edit','')
            ->setIcon('pen')
            ->setTitle('Editovat');

        $grid->addAction('delete', '')
            ->setIcon('trash')
            ->setTitle('Smazat')
            ->setConfirmation(new StringConfirmation('Chcete odstranit tohoto uživatele?'));

        return $grid;
    }

}
