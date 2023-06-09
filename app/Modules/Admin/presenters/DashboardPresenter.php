<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


final class DashboardPresenter extends BasePresenter
{

    public function startup()
    {
        parent::startup();
        if (!$this->getUser()->isLoggedIn())
        {
            $this->redirect('Login:default');
        }

    }
    public function renderDefault()
    {
        $this->template->books = $this->booksRepository->findAll()->fetchAll();
    }


}
