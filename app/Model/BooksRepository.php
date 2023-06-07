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
          PRIMARY_TABLE_FILE = 'file';


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
//
//    public function findArticleById(int $id): Selection
//    {
//        return $this->database
//            ->table(self::PRIMARY_TABLE)
//            ->where('id', $id);
//    }
//
//    public function insertArticle($data)
//    {
//        return $this->findAll()->insert($data);
//    }
//
//    public function updateArticle($articleId,$data)
//    {
//        return $this->getArticleById($articleId)->update($data);
//    }
//
//    public function getArticleById($id): ActiveRow
//    {
//        return $this->findAll()->get($id);
//    }
//
//    public function deleteArticle($id)
//    {
//        $row = $this->findArticleById($id);
//
//        $article = $row->fetch();
//        if (!$article) {
//            throw new Exception('Record does not exist');
//        }
//        $row->delete();
//    }

}