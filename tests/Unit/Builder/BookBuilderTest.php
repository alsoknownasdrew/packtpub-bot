<?php

declare(strict_types=1);

namespace PPBot\Tests\Unit\Builder;

use DateTime;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use PPBot\Builder\BookBuilder;
use PPBot\Entity\Author;
use PPBot\Entity\Book;

class BookBuilderTest extends TestCase
{
    /** @var BookBuilder|MockObject */
    private $bookBuilder;

    protected function setUp(): void
    {
        $this->bookBuilder = new BookBuilder();
    }

    protected function tearDown(): void
    {
        unset($this->bookBuilder);
    }

    public function bookDataProvider(): array
    {
        return [
            [
                'bookData' => [
                    'id' => 1,
                    'title' => 'Lorem Ipsum',
                    'authors' => [
                        new Author(1, 'John Doe')
                    ],
                    'publicationDate' => new DateTime(),
                    'description' => 'Lorem ipsum dolor sit amet',
                    'coverURL' => 'https://example.com',
                ],
            ],
        ];
    }

    /**
     * @test
     * @dataProvider bookDataProvider
     */
    public function createsBook(array $bookData): void
    {
        $book = $this->bookBuilder
            ->id($bookData['id'])
            ->title($bookData['title'])
            ->authors($bookData['authors'])
            ->publicationDate($bookData['publicationDate'])
            ->description($bookData['description'])
            ->coverURL($bookData['coverURL'])
            ->build();

        self::assertInstanceOf(Book::class, $book);
    }
}
