<?php

declare(strict_types=1);

namespace PPBot\Service\PacktPub;

use Psr\Http\Message\ResponseInterface;

interface PacktPubClientInterface
{
    public function fetchTodaysOffer(): array;

    public function fetchBookById(int $id): array;

    public function fetchAuthorById(int $id): array;

    public function fetchCoverURLByBookId(int $id): string;
}
