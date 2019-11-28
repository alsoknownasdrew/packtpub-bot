<?php

declare(strict_types=1);

namespace PPBot\Book\Builder;

use PPBot\Book\Entity\Book;

interface BookBuilderInterface
{
    public function build(): Book;
}
