<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


use Nette\Forms\Form,
    App\Model\GenresRepository;

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

    public function createComponentGenreForm()
    {
        $form = new \Nette\Application\UI\Form();

        $form->addText(GenresRepository::PRIMARY_TABLE_GENRE,'Žánry')
            ->setRequired();
        $form->addSubmit('send','Potvrdit');

        $form->onSuccess[] = [$this,'genreFormSuceeded'];

        return $form;
    }

    public function genreFormSuceeded($form,$data)
    {
        $inputGenre = explode(', ',$data->genre);

        foreach ($inputGenre as $item){
            $data->genre = $item;
            $this->genresRepository->findAll()->insert($data);
        }

    }
}
