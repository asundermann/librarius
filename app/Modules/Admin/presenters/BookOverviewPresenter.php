<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use Nette;


final class BookOverviewPresenter extends BasePresenter
{

    public function renderDefault(int $page = 1)
    {

        $booksCount = $this->booksRepository->getBooksCount();

        $paginator = new Nette\Utils\Paginator;
        $paginator->setPage($page);
        $paginator->setItemsPerPage(12);
        $paginator->setItemCount($booksCount);

        $this->template->books = $this->booksRepository->findBooksToOverview($paginator->getLength(), $paginator->getOffset());
        $this->template->paginator = $paginator;

    }

    public function renderDetail($id)
    {
        $book = $this->booksRepository
            ->getBookById($id);

        if (!$book) {
            $this->error('Článek nenalezen!');
        }

        $this->template->bookInfo = $book;
    }

}
