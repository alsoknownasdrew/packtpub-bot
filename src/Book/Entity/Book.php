<?php

declare(strict_types=1);

namespace PPBot\Book\Entity;

use DateTime;

class Book
{
    /** @var int */
    private $id;

    /** @var string */
    private $title;

    /** @var Author[] */
    private $authors;

    /** @var DateTime */
    private $publicationDate;

    /** @var string */
    private $description;

    /** @var string */
    private $coverURL;

    public function __construct(int $id, string $title, array $authors, DateTime $publicationDate, string $description, string $coverUrl)
    {
        $this->id = $id;
        $this->title = $title;
        $this->authors = $authors;
        $this->publicationDate = $publicationDate;
        $this->description = $description;
        $this->coverURL = $coverUrl;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Author[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }

    public function getPublicationDate(): DateTime
    {
        return $this->publicationDate;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getCoverURL(): string
    {
        return $this->coverURL;
    }
}
