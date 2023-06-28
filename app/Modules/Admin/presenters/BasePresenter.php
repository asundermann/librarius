<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use App\Model,
    App\services\FileService,
    Nette;
use Nette\Application\ForbiddenRequestException;


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

    private function isAllowed($privilege, $resource = null): bool
    {
        $resource = $resource ?? $this->getCurrentPresenterName(); // current presenter name as fallback
        return $this->user->isAllowed($resource, $privilege);
    }

    public function canDelete($throwable = true, $resource = null): bool
    {
        $isAllowed = $this->isAllowed('delete', $resource);
        if (!$isAllowed && $throwable) {
            throw new ForbiddenRequestException('Na mazání nemáte práva');
        }
        return $isAllowed;
    }

    public function canEdit($throwable = true, $resource = null): bool
    {
        $isAllowed = $this->isAllowed('edit', $resource);
        if (!$isAllowed && $throwable) {
            throw new ForbiddenRequestException('Na úpravu nemáte práva');
        }
        return $isAllowed;
    }

    public function canAdd($throwable = true, $resource = null): bool
    {
        $isAllowed = $this->isAllowed('add', $resource);
        if (!$isAllowed && $throwable) {
            throw new ForbiddenRequestException('Na vytváření nemáte práva');
        }
        return $isAllowed;
    }

    public function canView($throwable = true, $resource = null): bool
    {
        $isAllowed = $this->isAllowed('view', $resource);
        if (!$isAllowed && $throwable) {
            $this->redirect('BookOverview:default');
        }
        return $isAllowed;
    }

    public function getCurrentPresenterName(): string
    {
        return explode(':', $this->name)[1];
    }
}
