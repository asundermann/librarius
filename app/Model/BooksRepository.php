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
          PRIMARY_TABLE_BUY_ORIGINAL = 'buy_original',
          PRIMARY_TABLE_REVIEW = 'review',
          PRIMARY_TABLE_CONTENT = 'content',
          PRIMARY_TABLE_IMAGE = 'image',
          PRIMARY_TABLE_FILE_PDF = 'file_pdf',
          PRIMARY_TABLE_FILE_EPUB = 'file_epub',
          PRIMARY_TABLE_USER_PUBLISHED_ID = 'user_published_id',
          PRIMARY_TABLE_USER_EDITED_ID = 'user_edited_id';


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


    public function findBooksBySearchBar($params)
    {
        return $this->database
            ->query("SELECT * FROM `books` 
                         WHERE `author` 
                         LIKE '%$params%' OR `title`
                         LIKE '%$params%';");
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

    public function getBooksCount(){
        return $this->findAll()->count();
    }

    public function findBooksToOverview(int $limit, int $offset): Nette\Database\ResultSet
    {
        return $this->database->query('
            SELECT * FROM books
            LIMIT ? OFFSET ?',
            $limit,$offset
        );
    }


}