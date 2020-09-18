<?php
declare(strict_types=1);

namespace PPBot\Tests\Unit\Fetcher;

use PHPUnit\Framework\MockObject\MockObject;
use PPBot\Builder\BookBuilder;
use PPBot\Fetcher\BookAPIFetcher;
use PHPUnit\Framework\TestCase;
use PPBot\Fetcher\BookFetcherInterface;
use PPBot\Service\PacktPub\PacktPubClient;
use PPBot\Service\PacktPub\PacktPubClientInterface;

class BookAPIFetcherTest extends TestCase
{
    /** @var BookFetcherInterface */
    private $bookFetcher;

    /** @var PacktPubClient|MockObject */
    private $packtPubClient;

    protected function setUp(): void
    {
        $this->packtPubClient = $this->createMock(PacktPubClientInterface::class);
        $this->bookFetcher = new BookAPIFetcher($this->packtPubClient, new BookBuilder());
    }

    protected function tearDown(): void
    {
        unset($this->bookFetcher, $this->packtPubClient);
    }

    public function bookDataProvider(): array
    {
        return [
            [
                'todaysOfferData' => [

                ],
            ],
        ];
    }

    /** @test */
    public function returnsBook(): void
    {
        $this->packtPubClient
            ->method('fetchTodaysOffer()')
            ->willReturn();
    }
}
