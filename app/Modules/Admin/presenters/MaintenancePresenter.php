<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


use App\Model\BooksRepository;
use Nette\Forms\Form;

final class MaintenancePresenter extends BasePresenter
{

    public function renderDefault()
    {
    }

    public function createComponentMaintenanceForm()
    {
        $form = new \Nette\Application\UI\Form;

        $form->addUpload('soubor','Soubor');
        $form->addSubmit('send','Odeslat');
        $form->onSuccess[] = [$this,'maintenanceFormSucceeded'];


        return $form;
    }

    public function maintenanceFormSucceeded($form,$data)
    {
        $soubor = $data->soubor;
    }
}
