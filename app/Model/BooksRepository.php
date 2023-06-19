<?php
namespace App\Model;

use Nette,
 Nette\Database\Table\Selection,
 Nette\Database\Table\ActiveRow,
 Exception;

class BooksRepository
{
    const PRIMARY_TABLE = 'books',
          PRIMARY_TABLE_ID = 'id',
          PRIMARY_TABLE_TITLE = 'title',
          PRIMARY_TABLE_AUTHOR = 'author',
          PRIMARY_TABLE_CONTENT = 'content',
          PRIMARY_TABLE_IMAGE = 'image',
          PRIMARY_TABLE_FILE_PDF = 'file_pdf',
          PRIMARY_TABLE_FILE_EPUB = 'file_epub';


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

    public function findBookById($id): Selection
    {
        return $this->database
            ->table(self::PRIMARY_TABLE)
            ->where('id', $id);
    }

    public function getBookById($id): ActiveRow
    {
        return $this->findAll()->get($id);
    }

    public function insertBook($data)
    {
        return $this->findAll()->insert($data);
    }

    public function updateBook($bookId,$data)
    {
        return $this->getBookById($bookId)->update($data);
    }

    public function deleteBook($id)
    {
        $row = $this->findBookById($id);

        $book = $row->fetch();
        if (!$book) {
            throw new Exception('Record does not exist');
        }
        $row->delete();
    }

}