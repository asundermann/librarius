<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette,
    App\Model\UsersRepository,
    Nette\Application\UI\Form;


final class LoginPresenter extends Nette\Application\UI\Presenter
{

    /** @var UsersRepository */
    private $users;
    private $passwords;

    public function __construct(UsersRepository $users, Nette\Security\Passwords $passwords)
    {
        $this->users = $users;
        $this->passwords = $passwords;
    }

    public function renderDefault()
    {
        $this->setLayout('login');

        if ($this->getUser()->isLoggedIn())
        {
            $this->redirect('Dashboard:default');
        }
    }

    public function actionMaintenance()
    {
        $password = $this->passwords->hash("test");
        $this->users->findAll()->insert
        ([
            'email' => "test@testovic.cz",
            'username' => "test",
            'password' => $password,
            'role' => "admin"
        ]);
        $this->redirect('Dashboard:default');
    }

    protected function createComponentLoginForm(): Form
    {
        $form = new Form();
        $form->addText(UsersRepository::PRIMARY_TABLE_USERNAME,'Přihlašovací jméno')
            ->setRequired();
        $form->addPassword(UsersRepository::PRIMARY_TABLE_PASSWORD,'Heslo')
            ->setRequired();
//        $form->addCheckbox('keepLoggedIn','Zůstat přihlášen');
        $form->addSubmit('send',"Potvrdit");
        $form->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $form;
    }

    public function loginFormSucceeded($form, $data)
    {
        try {
            $this->getUser()->login($data->username,$data->password);
        }catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage($e->getMessage());
            $this->redirect('Login:default');
        }

        $this->redirect('Dashboard:default');
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl/a jsi úspěšně odhlášen.','success');
        $this->redirect('Login:default');
    }
}
