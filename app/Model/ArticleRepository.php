<?php
namespace App\Model;

use Nette;
use Nette\Database\Table\Selection;

class ArticleRepository
{
    const PRIMARY_TABLE = 'articles',
          PRIMARY_TABLE_ID = 'id',
          PRIMARY_TABLE_TITLE = 'title',
          PRIMARY_TABLE_CONTENT = 'content',
          PRIMARY_TABLE_PEREX = 'perex',
          PRIMARY_TABLE_DATE_PUBLISH = 'date_publish',
          PRIMARY_TABLE_DATE_CREATED = 'date_created';


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

    public function findArticleById(int $id): Selection
    {
        return $this->database
            ->table(self::PRIMARY_TABLE)
            ->where('id', $id);
    }

    public function insertArticle($data)
    {
        return $this->findAll()->insert($data);
    }

    public function updateArticle($articleId,$data)
    {
        return $this->getArticleById($articleId)->update($data);
    }

    public function getArticleById($id)
    {
        return $this->findAll()->get($id);
    }


}