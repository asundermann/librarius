<?php

use Nette,
    Nette\Security\SimpleIdentity;


class MyAuthenticator implements Nette\Security\Authenticator
{
    private $database;
    private $passwords;

    public function __construct(Nette\Database\Explorer $database, Nette\Security\Passwords $passwords) {
        $this->database = $database;
        $this->passwords = $passwords;
    }

    public function authenticate(string $username, string $password): SimpleIdentity
    {
        $row = $this->database->table('users')
            ->where('username', $username)
            ->fetch();

        if (!$row) {
            throw new Nette\Security\AuthenticationException('Uživatel nenalezen.');
        }

        if (!$this->passwords->verify($password, $row->password)) {
            throw new Nette\Security\AuthenticationException('Špatné heslo.');
        }

        return new SimpleIdentity($row->id, $row->role, ['username' => $row->username]);
    }
}
