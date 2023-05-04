<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model,
    Nette;


class BasePresenter extends Nette\Application\UI\Presenter
{

    /** @var Model\UsersRepository */
    public $users;

    public function __construct(Model\UsersRepository $users)
    {
        $this->users = $users;
    }

    public  function  beforeRender()
    {
        parent::beforeRender();

        $this->template->navItems =
        [
            'Overview' => (object) [
                'presenter' => 'Dashboard:default',
                'title' => 'Přehled',

            ],
            'Main' => (object) [
                'presenter' => 'Dashboard:main',
                'title' => 'Hlavní',
            ],
            'Articles' => (object) [
                'presenter' => 'Article:default',
                'title' => 'Články',
            ]
        ];

    }

    public function startup()
    {
        parent::startup();

        $loggedUserId = $this->getUser()->getId();
        $this->template->loggedUser = $this->users->findAll()->where('id',$loggedUserId)->fetch();

        if (!$this->getUser()->isLoggedIn())
        {
            $this->redirect('Login:default');
            $this->terminate();
        }

    }

}
