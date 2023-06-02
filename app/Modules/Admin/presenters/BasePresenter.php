<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use App\Model;
use Nette;


class BasePresenter extends Nette\Application\UI\Presenter
{

    /** @var Model\UsersRepository */
    public $users;

    public $passwords;

    /** @var Model\ArticleRepository */
    public $articles;

    public function __construct(Model\UsersRepository $users, Model\ArticleRepository $articles, Nette\Security\Passwords $passwords)
    {
        $this->users = $users;
        $this->articles = $articles;
        $this->passwords = $passwords;

    }

    public  function  beforeRender()
    {
        parent::beforeRender();

        $this->template->navItems =
        [
            'Overview' => (object) [
                'presenter' => 'Dashboard:default',
                'icon' => 'fas fa-archive',
                'title' => 'Přehled',

            ],
            'About' => (object) [
                'presenter' => 'About:default',
                'icon' => 'fas fa-newspaper',
                'title' => 'O projektu',

            ],
            'Articles' => (object) [
                'presenter' => 'Article:default',
                'icon' => 'fas fa-folder-open',
                'title' => 'Nahrát',
            ],
            'Users' => (object) [
                'presenter' => 'Users:default',
                'icon' => 'fas fa-user-circle',
                'title' => 'Uživatelé',
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
