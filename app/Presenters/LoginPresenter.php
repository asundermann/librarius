<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette,
    Nette\Application\UI\Form;


final class LoginPresenter extends Nette\Application\UI\Presenter
{

    public function renderDefault(){

    }

    public function createComponentLoginForm(): Form
    {
        $loginForm = new Form();
        $loginForm->addText('username','Přihlašovací jméno')
            ->setRequired();
        $loginForm->addPassword('password','Heslo')
            ->setRequired();
        $loginForm->addSubmit('send',"Potvrdit");
        $loginForm->onSuccess[] = [$this, 'loginFormSucceeded'];
        return $loginForm;
    }

    public function loginFormSucceeded($loginForm, $data){


        $this->redirect('Dashboard:default');
        $this->flashMessage('Byl jsi úspěšně přihlášen');
    }

}
