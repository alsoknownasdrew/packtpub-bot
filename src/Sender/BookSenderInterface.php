<?php

declare(strict_types=1);

namespace PPBot\Sender;

use PPBot\Book\Entity\Book;

interface BookSenderInterface
{
    public function send(Book $book): void;
}
