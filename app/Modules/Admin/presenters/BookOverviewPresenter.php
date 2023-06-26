<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;

use Nette,
   Nette\Application\UI\Form;
use function Symfony\Component\String\b;


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

    public function renderResults($term)
    {
        $this->template->term = $term;
        $this->template->books =  $this->booksRepository->findBooksBySearchBar($term)->fetchAll();
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

    protected function createComponentSearchForm()
    {
        $form = new Form;

        $form->addText('term', '')
        ->setRequired();
        $form->addSubmit('send','' );

        $form->onSuccess[] = [$this, 'searchFormSucceeded'];
        return $form;
    }

    public function searchFormSucceeded($form, $data)
    {
        $this->redirect(':results', $data->term);
    }

}
