<?php

declare(strict_types=1);

namespace PPBot\Builder;

use PPBot\Entity\Book;

interface BookBuilderInterface
{
    public function build(): Book;
}
