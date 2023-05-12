<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use App\Model\ArticleRepository;
use Nette\Application\UI\Form;
use Ublaboo\DataGrid\DataGrid;


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

    public function createComponentGrid($name)
    {
        $grid = new DataGrid($this, $name);

        $grid->setDataSource($this->users->findAll());
        $grid->addColumnText('username', 'Jméno');
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
        $form->addText(ArticleRepository::PRIMARY_TABLE_DATE_CREATED,'Datum publikace')
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
//        $this->articles->insertArticle($data);
        bdump($data);
//        $this->redirect('Article:default');
    }

}
