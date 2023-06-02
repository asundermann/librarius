<?php
namespace App\Model;

use Nette,
    Nette\Database\Table\ActiveRow,
    Nette\Database\Table\Selection,
    Exception;


class UsersRepository
{
    const
        PRIMARY_TABLE = 'users',
        PRIMARY_TABLE_ID = 'id',
        PRIMARY_TABLE_USERNAME = 'username',
        PRIMARY_TABLE_EMAIL = 'email',
        PRIMARY_TABLE_PASSWORD = 'password',
        PRIMARY_TABLE_ROLE = 'role';

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

    public function insertUser($data)
    {
        return $this->findAll()->insert($data);
    }

    public function findUserById(int $id): Selection
    {
        return $this->database
            ->table(self::PRIMARY_TABLE)
            ->where('id', $id);
    }

    public function getUserById($id): ActiveRow
    {
        return $this->findAll()->get($id);
    }

    public function updateUser($userId,$data)
    {
        return $this->getUserById($userId)->update($data);
    }

    public function deleteUser($id)
    {
        $row = $this->findUserById($id);

        $user = $row->fetch();
        if (!$user) {
            throw new Exception('Record does not exist');
        }
        $row->delete();
    }


}