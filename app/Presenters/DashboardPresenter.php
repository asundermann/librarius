<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;


final class DashboardPresenter extends BasePresenter
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
    public function renderDefault(){
//        $this->template->user = $this->users->findAll();
    }

    public function renderMain(){
    }

}
