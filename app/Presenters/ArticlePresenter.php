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
    public function renderDefault(){
    }

    public function renderMain(){
    }

}
