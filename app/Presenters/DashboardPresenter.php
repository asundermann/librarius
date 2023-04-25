<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model,
    Nette,
    Nette\Application\UI\Form;


final class DashboardPresenter extends Nette\Application\UI\Presenter
{

    /** @var Model\UsersRepository */
    private $users;

    public function __construct(Model\UsersRepository $users)
    {
        $this->users = $users;
    }

    public function renderDefault(){
        $this->template->user = $this->users->findAll();

    }

}
