<?php

declare(strict_types=1);

namespace PPBot\Book\Fetcher;

use PPBot\Book\Builder\BookBuilder;
use PPBot\Book\Entity\Author;
use PPBot\Book\Entity\Book;
use PPBot\Service\PacktPub\PacktPubClientInterface;

class BookAPIFetcher implements BookFetcherInterface
{
    /** @var PacktPubClientInterface */
    private $packPubClient;

    /** @var BookBuilder */
    private $bookBuilder;

    public function __construct(PacktPubClientInterface $packPubClient, BookBuilder $bookBuilder)
    {
        $this->packPubClient = $packPubClient;
        $this->bookBuilder = $bookBuilder;
    }

    public function fetch(): Book
    {
        $todaysOfferData = $this->packPubClient->fetchTodaysOffer();
        $bookData = $this->packPubClient->fetchBookById((int) $todaysOfferData['productId']);
        $client = $this->packPubClient;
        $authorsCollection = array_map(static function ($authorId) use ($client) {
            $authorData = $client->fetchAuthorById((int) $authorId);

            return new Author((int) $authorData['id'], $authorData['author']);
        }, $bookData['authors']);

        return $this->bookBuilder
            ->id((int) $bookData['productId'])
            ->title($bookData['title'])
            ->description($bookData['oneLiner'])
            ->authors($authorsCollection)
            ->coverURL($this->packPubClient->fetchCoverURLByBookId((int) $bookData['productId']))
            ->publicationDate(\DateTime::createFromFormat('Y-m-d\TH:i:s.uP', $bookData['publicationDate']))
            ->build();
    }
}
