<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


use App\Model\BooksRepository;
use Nette\Forms\Form;

final class MaintenancePresenter extends BasePresenter
{

    public function renderDefault()
    {
        $this->canView();
    }
    public function renderContact()
    {
    }

    public function createComponentContactForm()
    {
        $form = new \Nette\Application\UI\Form();

        $form->addEmail('email','E-mail')
            ->setRequired();
        $form->addTextArea('content','Obsah zprávy')
            ->setRequired();
        $form->addSubmit('send','Odeslat');
//        $form->addUpload('file','Soubor');
        $form->onSuccess[] = [$this,'contactFormSuceeded'];

        return $form;
    }
    public function contactFormSuceeded($form,$data)
    {

    }

}
