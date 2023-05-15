<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use App\Model\ArticleRepository,
    Nette\Application\UI\Form,
    Ublaboo\DataGrid\DataGrid;
use Ublaboo\DataGrid\Localization\SimpleTranslator;

final class ArticlePresenter extends BasePresenter
{
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

    public function createComponentGrid($name): DataGrid
    {
        $grid = new DataGrid($this, $name);
        $selection = $this->articles->findAll();

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

        $grid->addColumnText('title', 'Název')
        ->setSortable()
        ->setFilterText();
        $grid->addColumnDateTime('date_created', 'Datum vytvoření')
        ->setSortable();
        $grid->addColumnDateTime('date_publish', 'Datum publikace')
        ->setSortable();

        $grid->addAction('edit','')
        ->setIcon('pen')
        ->setTitle('Editovat');
        $grid->addAction('delete', '')
            ->setIcon('trash')
            ->setTitle('Smazat');

        return $grid;
    }


    protected function createComponentArticleForm()
    {
//        $caption = $this->record ? 'Upravit článek':'Vytvořit článek';
        $form = new Form;
        $form->addText(ArticleRepository::PRIMARY_TABLE_TITLE,'Titulek',)
            ->setDefaultValue('Titulek')
            ->setRequired();
        $form->addText(ArticleRepository::PRIMARY_TABLE_PEREX,'Perex')
            ->setDefaultValue('Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Nam quis nulla. Maecenas lorem. Cum sociis natoque penatibus et magnis dis parturient montes.')
            ->setRequired();
        $form->addTextArea(ArticleRepository::PRIMARY_TABLE_CONTENT,'Obsah')
            ->setHtmlAttribute('class','js-wysiwyg');
        $form->addText(ArticleRepository::PRIMARY_TABLE_DATE_PUBLISH,'Datum publikace')
            ->setDefaultValue('2023-05-26')
            ->setHtmlType('date')
            ->setRequired();

        $form->addSubmit('send','Vytvořit')
        ->setHtmlAttribute('id','send');
        $form->onSuccess[] = [$this,'articleFormSucceeded'];

        return $form;
    }

    public function articleFormSucceeded($form, $data)
    {
        // TODO i have to fetch JS data from wysiwyg and send them to DB...
        $this->articles->insertArticle($data);
        $this->flashMessage('Článek přidán úspěšně', 'success');
//        bdump($data);
//        $this->redirect('Article:default');
    }

}
