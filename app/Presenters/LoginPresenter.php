<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette,
    App\Model,
    Nette\Application\UI\Form;


final class LoginPresenter extends Nette\Application\UI\Presenter
{

    /** @var Model\UsersRepository */
    private $users;
    private $passwords;

    public function __construct(Model\UsersRepository $users, Nette\Security\Passwords $passwords)
    {
        $this->users = $users;
        $this->passwords = $passwords;
    }

    public function renderDefault()
    {
        $this->setLayout('login');

        if ($this->getUser()->isLoggedIn())
        {
            $this->redirect('Dashboard:default');
        }
    }

    public function actionMaintenance()
    {
        $password = $this->passwords->hash("test");
        $this->users->findAll()->insert
        ([
            'username' => "pietro",
            'password' => $password,
            'role' => "admin"
        ]);
    }

    protected function createComponentLoginForm(): Form
    {
        $loginForm = new Form();
        $loginForm->addText('username','Přihlašovací jméno')
            ->setRequired();
        $loginForm->addPassword('password','Heslo')
            ->setRequired();
        $loginForm->addCheckbox('keepLoggedIn','Zůstat přihlášen');
        $loginForm->addSubmit('send',"Potvrdit");
        $loginForm->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $loginForm;
    }

    public function loginFormSucceeded($loginForm, $data)
    {
        try {
            $this->getUser()->login($data->username,$data->password);
        }catch (Nette\Security\AuthenticationException $e) {
            $this->flashMessage($e->getMessage());
            $this->redirect('Login:default');
        }

        $this->redirect('Dashboard:default');
    }

    public function actionOut()
    {
        $this->getUser()->logout();
        $this->flashMessage('Byl/a jsi úspěšně odhlášen.');
        $this->redirect('Login:default');
    }
}
