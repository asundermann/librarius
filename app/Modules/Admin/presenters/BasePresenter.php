<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use App\Model,
    App\services\FileService,
    Nette;


class BasePresenter extends Nette\Application\UI\Presenter
{


    public $passwords;
    /** @var Model\UsersRepository */
    public $users;
    /** @var Model\BooksRepository */
    public $booksRepository;
    /** @var Model\ArticleRepository */
    public $articles;
    /** @var FileService */
    public $FileService;


    public function __construct
    (
        Model\UsersRepository $users,
        Model\ArticleRepository $articles,
        Nette\Security\Passwords $passwords,
        Model\BooksRepository $booksRepository,
        FileService $FileService
    )
    {
        $this->users = $users;
        $this->booksRepository = $booksRepository;
        $this->articles = $articles;
        $this->passwords = $passwords;
        $this->FileService = $FileService;

    }

    public  function  beforeRender()
    {
        parent::beforeRender();

        $loggedUserId = $this->getUser()->getId();
        $loggedUser = $this->users->findAll()->where('id',$loggedUserId)->fetch();


        if ($loggedUser->role == "user")
        {
            $this->template->navItems =
                [
                    'Overview' => (object) [
                        'presenter' => 'BookOverview:default',
                        'icon' => 'fas fa-archive',
                        'title' => 'Přehled',

                    ],
                    'About' => (object) [
                        'presenter' => 'About:default',
                        'icon' => 'fas fa-newspaper',
                        'title' => 'O projektu',

                    ],
                ];
        } elseif($loggedUser->role == "admin")
        {
        $this->template->navItems =
        [
                    'Overview' => (object) [
                        'presenter' => 'BookOverview:default',
                        'icon' => 'fas fa-archive',
                        'title' => 'Přehled',

                    ],
                    'About' => (object) [
                        'presenter' => 'About:default',
                        'icon' => 'fas fa-newspaper',
                        'title' => 'O projektu',

                    ],
                    'Books' => (object) [
                        'presenter' => 'Books:default',
                        'icon' => 'fas fa-book-open',
                        'title' => 'Knihy',
                    ],
                    'Articles' => (object) [
                        'presenter' => 'Article:default',
                        'icon' => 'fas fa-folder-open',
                        'title' => 'Články',
                    ],
                    'Users' => (object) [
                        'presenter' => 'Users:default',
                        'icon' => 'fas fa-user-circle',
                        'title' => 'Uživatelé',
                    ]
                ];
        }elseif($loggedUser->role == "librarius")
        {
            $this->template->navItems =
                    [
                        'Overview' => (object) [
                            'presenter' => 'BookOverview:default',
                            'icon' => 'fas fa-archive',
                            'title' => 'Přehled',

                        ],
                        'About' => (object) [
                            'presenter' => 'About:default',
                            'icon' => 'fas fa-newspaper',
                            'title' => 'O projektu',

                        ],
                        'Books' => (object) [
                            'presenter' => 'Books:default',
                            'icon' => 'fas fa-book-open',
                            'title' => 'Knihy',
                        ],
                    ];
        }

        $year = new \DateTime('today');
        $this->template->year = $year->format('Y');
    }

    public function startup()
    {
        parent::startup();

        $loggedUserId = $this->getUser()->getId();
        $loggedUser = $this->users->findAll()->where('id',$loggedUserId)->fetch();
        $this->template->loggedUser = $loggedUser;

        if (!$this->getUser()->isLoggedIn())
        {
            $this->redirect('Login:default');
        }

    }

}
