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

    public function __construct(Model\UsersRepository $users)
    {
        $this->users = $users;
    }

    public function renderDefault()
    {
        bdump($this->users->findAll()->fetch());
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

    public function loginFormSucceeded($loginForm, $data){

        $users = $this->users->findAll()->fetchAll();
        $username = $data['username'];
        $password = $data['password'];

        try {
            $this->getUser()->login($username,$password);
        }catch (Nette\Security\AuthenticationException $e) {
            $loginForm->addError($e->getMessage());
            return;
        }
        $this->redirect('Dashboard:default');

//        $this->flashMessage('Byl jsi úspěšně přihlášen');
    }

}
