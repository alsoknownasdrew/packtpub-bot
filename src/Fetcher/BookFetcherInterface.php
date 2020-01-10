<?php

declare(strict_types=1);

namespace PPBot\Fetcher;

use PPBot\Entity\Book;

interface BookFetcherInterface
{
    public function fetch(): Book;
}
