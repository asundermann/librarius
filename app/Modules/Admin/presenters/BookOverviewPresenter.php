<?php

declare(strict_types=1);

namespace App\Modules\Admin\presenters;


final class BookOverviewPresenter extends BasePresenter
{

    public function renderDefault()
    {
        $this->template->books = $this->booksRepository->findAll()->order('RAND()')->fetchAll();
    }


}
