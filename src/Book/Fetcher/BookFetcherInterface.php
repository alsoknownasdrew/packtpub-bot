<?php

declare(strict_types=1);

namespace PPBot\Book\Fetcher;

use PPBot\Book\Entity\Book;

interface BookFetcherInterface
{
    public function fetch(): Book;
}
