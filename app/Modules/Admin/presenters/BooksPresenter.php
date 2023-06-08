<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use Nette\Application\UI\Form,
    Ublaboo\DataGrid\DataGrid,
    Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation,
    Ublaboo\DataGrid\Localization\SimpleTranslator,
    App\Model\BooksRepository,
    Nette\Utils\FileSystem,
    Nette\Utils\Image,
    Nette\Http\FileUpload;
use function Symfony\Component\String\b;

final class BooksPresenter extends BasePresenter
{
    public const FILE_DIR = UPLOAD_DIR.'/book-files';
    public const IMAGE_DIR = UPLOAD_DIR.'/book-covers';

    public function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn())
        {
            $this->redirect('Login:default');
            $this->terminate();
        }

    }

    public function renderDefault()
    {
    }

    public function renderAdd()
    {
    }

//    public function actionEdit($id)
//    {
//        $article = $this->articles
//            ->getArticleById($id);
//
//        if (!$article) {
//            $this->error('Článek nenalezen!');
//        }
//
//        $date = date_format($article->date_publish,'Y-m-d');
//        $articleArray = $article->toArray();
//        $defaults = array_replace($articleArray,['date_publish'=> $date]);
//
//        $this->getComponent('articleForm')
//            ->setDefaults($defaults);
//    }
//
//    public function actionDelete($id){
//        try {
//            $this->articles->deleteArticle($id);
//            $this->flashMessage('Článek byl úspěšně smazán','success');
//        } catch (Exception $e) {
//            $this->flashMessage($e->getMessage(), 'warning');
//        }
//        $this->redirect('default');
//    }

    public function createComponentGrid($name): DataGrid
    {
        $grid = new DataGrid($this, $name);
        $selection = $this->booksRepository->findAll();

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

        $grid->addColumnText('title', 'Název titulu')
            ->setSortable()
            ->setFilterText();
        $grid->addColumnText('author', 'Autor')
            ->setSortable()
            ->setFilterText();
        $grid->addAction('edit','')
            ->setIcon('pen')
            ->setTitle('Editovat');
        $grid->addAction('delete', '')
            ->setIcon('trash')
            ->setTitle('Smazat')
            ->setConfirmation(new StringConfirmation('Chcete odstranit tento článek?'));

        return $grid;
    }

    protected function createComponentBooksForm()
    {
        $presenter = $this->getAction();
        $caption = $presenter == 'add' ? 'Vytvořit' : 'Upravit';

        $form = new Form;
        $form->addText(BooksRepository::PRIMARY_TABLE_TITLE)
            ->setRequired();
        $form->addText(BooksRepository::PRIMARY_TABLE_AUTHOR)
            ->setRequired();
        $form->addTextArea(BooksRepository::PRIMARY_TABLE_CONTENT)
            ->setOption('class', 'wysiwyg-wrapper')
            ->setHtmlAttribute('class', 'js-wysiwyg');
        $form->addUpload(BooksRepository::PRIMARY_TABLE_IMAGE)
            ->addRule($form::Image, 'Obrázek musí být v JPEG, PNG, GIF, WebP or AVIF.')
            ->setRequired();
        $form->addUpload(BooksRepository::PRIMARY_TABLE_FILE);

        $form->addSubmit('send',$caption)
            ->setHtmlAttribute('id','send');
        $form->onSuccess[] = [$this,'booksFormSucceeded'];

        return $form;
    }

    public function booksFormSucceeded($form, $data)
    {
        bdump('Success');

        $image = $data->image;
        $this->uploadImage($image,self::IMAGE_DIR);


//        if(!$dir){
//            FileSystem::createDir($dir);
//        }else
//        {
//
//        }

        //
//        $articleId = $this->getParameter('id');
//
//        if ($articleId) {
//            $this->articles
//                ->updateArticle($articleId,$data);
//            $this->flashMessage('Článek byl upraven', 'success');
//
//        } else {
//            $post = $this->articles
//                ->insertArticle($data);
//            $this->flashMessage('Článek byl přidán', 'success');
//            $this->redirect('Article:edit',$post->id);
//
//        }

    }

    private function getRandomName(string $fileName): string
    {
        $ext = explode('.', $fileName);
        $ext = '.' . $ext[count($ext) - 1];
        return md5(time() . rand()) . $ext;
    }

    public function uploadImage($image,$directory)
    {
        $sanitName = $image->getSanitizedName();
        $randName = $this->getRandomName($sanitName);

        $image->move($directory.'/'.$randName);
    }


}
