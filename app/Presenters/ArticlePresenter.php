<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;


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

    protected function createComponentArticleForm()
    {
//        $caption = $this->record ? 'Upravit článek':'Vytvořit článek';
        $form = new Form;
        $form->addText('title','Titulek',)
            ->setRequired();
        $form->addText('perex','Perex')
            ->setRequired();
        $form->addTextArea('content','Obsah')
            ->setRequired();
        $form->addText('date','Datum publikace')
            ->setHtmlType('date')
            ->setRequired();

        $form->addSubmit('send','Vytvořit');
        $form->onSuccess[] = [$this,'articleFormSuccess'];

        return $form;
    }
}
