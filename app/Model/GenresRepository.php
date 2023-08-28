<?php
namespace App\Model;

use Nette,
 Nette\Database\Table\Selection,
 Nette\Database\Table\ActiveRow,
 Exception;

class GenresRepository
{
    const PRIMARY_TABLE = 'genres',
          PRIMARY_TABLE_ID = 'id',
          PRIMARY_TABLE_GENRE = 'genre';


    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Explorer $database)
    {
        $this->database = $database;
    }

    public function findAll(): Selection
    {
        return $this->database->table(self::PRIMARY_TABLE);
    }

    public function insertGenres($data)
    {
        return $this->findAll()->insert($data);
    }

    public function findGenreById(int $id): Selection
    {
        return $this->database
            ->table(self::PRIMARY_TABLE)
            ->where('id', $id);
    }

    public function deleteGenre($id)
    {
        $row = $this->findGenreById($id);

        $user = $row->fetch();
        if (!$user) {
            throw new Exception('Record does not exist');
        }
        $row->delete();
    }

}