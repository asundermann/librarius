<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use Nette\Application\UI\Form,
    Ublaboo\DataGrid\DataGrid,
    Ublaboo\DataGrid\Column\Action\Confirmation\StringConfirmation,
    Ublaboo\DataGrid\Localization\SimpleTranslator,
    App\Model\BooksRepository;

use Nette\Utils\FileSystem;
use function Symfony\Component\String\b;

final class BooksPresenter extends BasePresenter
{
    public const FILE_DIR = UPLOAD_DIR.'/book-files';
    public const IMAGE_DIR = UPLOAD_DIR.'/book-covers';


    public function renderDefault()
    {
    }

    public function renderAdd()
    {
    }

    public function actionEdit($id)
    {
        $book = $this->booksRepository
            ->getBookById($id);

        if (!$book) {
            $this->error('Článek nenalezen!');
        }

        $bookArray = $book->toArray();
        $this->template->bookArray = $bookArray;

        $this->getComponent('booksForm')
            ->setDefaults($bookArray);
    }

    public function actionDelete($id)
    {
        try {
            $book = $this->booksRepository
                ->findBookById($id)
                ->fetch();
            $this->FileService->delete(self::IMAGE_DIR,$book->image);
            FileSystem::delete(self::FILE_DIR.'/'.$book->title);
            $this->booksRepository->deleteBook($id);
            $this->flashMessage('Článek byl úspěšně smazán','success');
        } catch (Exception $e) {
            $this->flashMessage($e->getMessage(), 'warning');
        }
        $this->redirect('default');
    }

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
            ->setIcon('pencil')
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
        $form->addUpload(BooksRepository::PRIMARY_TABLE_FILE_PDF)
            ->addRule(Form::MIME_TYPE,'Požadovaný soubor musí být ve formátu PDF','application/x-pdf,application/pdf');
        $form->addUpload(BooksRepository::PRIMARY_TABLE_FILE_EPUB)
            ->addRule(Form::MIME_TYPE,'Požadovaný soubor musí být ve formátu ePUB','application/epub+zip');
        $form->addUpload(BooksRepository::PRIMARY_TABLE_IMAGE)
            ->addRule($form::Image, 'Obrázek musí být v JPEG, PNG, GIF, WebP or AVIF.')
            ->setRequired();
        $form->addSubmit('send',$caption)
            ->setHtmlAttribute('id','send');
        $form->onSuccess[] = [$this,'booksFormSucceeded'];

        return $form;
    }

    public function booksFormSucceeded($form, $data)
    {
        $bookId = $this->getParameter('id');


        $tmpImage = $data->image;
        $tmpPdf = $data->file_pdf;
        $tmpEpub = $data->file_epub;

        /**IMG**/
        $sanitImageName = $tmpImage->getSanitizedName();
        $randImageName = $this->FileService->getRandomName($sanitImageName);
        $tmpImagePath = $tmpImage->getTemporaryFile();
        $tmpImagePath = $randImageName;
        $data->image = $tmpImagePath;

        /**PDF**/
        $sanitPdfName = $tmpPdf->getSanitizedName();
        $randPdfName = $this->FileService->getRandomName($sanitPdfName);
        $tmpPdfPath = $tmpPdf->getTemporaryFile();
        $tmpPdfPath = $randPdfName;
        $data->file_pdf = $tmpPdfPath;

        /**EPUB**/
        $sanitEpubName = $tmpEpub->getSanitizedName();
        $randEpubName = $this->FileService->getRandomName($sanitEpubName);
        $tmpEpubPath = $tmpEpub->getTemporaryFile();
        $tmpEpubPath = $randEpubName;
        $data->file_epub = $tmpEpubPath;

        if ($bookId) {
            $book = $this->booksRepository
                ->findBookById($bookId)
                ->fetch();
            $this->FileService
                 ->update($tmpImage,self::IMAGE_DIR,$book->image,$randImageName);
            $this->FileService
                 ->update($tmpPdf,self::FILE_DIR.'/'.$data->title,$book->file_pdf,$randPdfName);
            $this->FileService
                 ->update($tmpEpub,self::FILE_DIR.'/'.$data->title,$book->file_epub,$randEpubName);
            $this->booksRepository
                 ->updateBook($bookId,$data);
            $this->flashMessage('Článek byl upraven', 'success');
            $this->redirect('Books:edit',$book->id);

        } else {
            $post = $this->booksRepository
                ->insertBook($data);
            $this->FileService
                 ->upload($tmpImage,self::IMAGE_DIR,$randImageName);
            $this->FileService
                 ->upload($tmpPdf,self::FILE_DIR.'/'.$data->title,$randPdfName);
            $this->FileService
                 ->upload($tmpEpub,self::FILE_DIR.'/'.$data->title,$randEpubName);
            $this->flashMessage('Článek byl přidán', 'success');
            $this->redirect('Books:edit',$post->id);
        }

    }

}
