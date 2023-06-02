<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


final class AboutPresenter extends BasePresenter
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


}
