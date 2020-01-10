<?php

declare(strict_types=1);

namespace PPBot\Builder;

use PPBot\Entity\Author;
use PPBot\Entity\Book;

class BookBuilder implements BookBuilderInterface
{
    private $bookData = [];

    public function id(int $id): BookBuilder
    {
        $this->bookData['id'] = $id;

        return $this;
    }

    public function title(string $title): BookBuilder
    {
        $this->bookData['title'] = $title;

        return $this;
    }

    /**
     * @param Author[]
     */
    public function authors(array $authors): BookBuilder
    {
        $this->bookData['authors'] = $authors;

        return $this;
    }

    public function publicationDate(\DateTime $publicationDate): BookBuilder
    {
        $this->bookData['publicationDate'] = $publicationDate;

        return $this;
    }

    public function description(string $description): BookBuilder
    {
        $this->bookData['description'] = $description;

        return $this;
    }

    public function coverURL(string $coverURL): BookBuilder
    {
        $this->bookData['coverURL'] = $coverURL;

        return $this;
    }

    public function build(): Book
    {
        return new Book(
            $this->bookData['id'],
            $this->bookData['title'],
            $this->bookData['authors'],
            $this->bookData['publicationDate'],
            $this->bookData['description'],
            $this->bookData['coverURL']
        );
    }
}
