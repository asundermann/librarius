<?php
namespace App\Model;

use Nette;

class UsersRepository
{
    const
        PRIMARY_TABLE = 'users',
        PRIMARY_TABLE_ID = 'id',
        PRIMARY_TABLE_USERNAME = 'username',
        PRIMARY_TABLE_PASSWORD = 'password',
        PRIMARY_TABLE_ROLES = 'roles';

    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    /** @return Nette\Database\Table\Selection */
    public function findAll()
    {
        return $this->database->table(self::PRIMARY_TABLE);
    }

}