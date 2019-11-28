<?php

declare(strict_types=1);

namespace PPBot\Service\PacktPub;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use PPBot\Exception\DataFetchingErrorException;

class PacktPubClient implements PacktPubClientInterface
{
    private const OFFER_URL = 'https://services.packtpub.com/free-learning-v1/offers';
    private const BOOK_URL = 'https://static.packt-cdn.com/products';
    private const AUTHOR_URL = 'https://static.packt-cdn.com/authors';

    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @throws DataFetchingErrorException
     */
    public function fetchTodaysOffer(): array
    {
        $currentDate = new \DateTime();
        $request = new Request(
            'GET',
            self::OFFER_URL
            . "?dateFrom={$currentDate->format('Y-m-d')}"
            . "&dateTo={$currentDate->modify('+1 day')->format('Y-m-d')}",
        );

        try {
            $response = $this->client->send($request);
        } catch (\Exception|GuzzleException $exception) {
            throw new DataFetchingErrorException('Failed to load book data', 500, $exception);
        }
        $todaysOfferResponseData = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $todaysOfferResponseData['data'][0];
    }

    /**
     * @throws DataFetchingErrorException
     */
    public function fetchBookById(int $id): array
    {
        $request = new Request(
            'GET',
            self::BOOK_URL . "/{$id}" . '/summary'
        );

        try {
            $response = $this->client->send($request);
        } catch (\Exception|GuzzleException $exception) {
            throw new DataFetchingErrorException("Failed to load book data with id {$id}", 500, $exception);
        }
        $bookResponseData = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $bookResponseData;
    }

    /**
     * @throws DataFetchingErrorException
     */
    public function fetchAuthorById(int $id): array
    {
        $request = new Request(
            'GET',
            self::AUTHOR_URL . "/{$id}"
        );

        try {
            $response = $this->client->send($request);
        } catch (\Exception|GuzzleException $exception) {
            throw new DataFetchingErrorException("Failed to load book data with id {$id}", 500, $exception);
        }

        $authorResponseData = \json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return $authorResponseData;
    }

    /**
     * @throws DataFetchingErrorException
     */
    public function fetchCoverURLByBookId(int $id): string
    {
        return "https://static.packt-cdn.com/products/{$id}/cover/smaller";
    }
}
