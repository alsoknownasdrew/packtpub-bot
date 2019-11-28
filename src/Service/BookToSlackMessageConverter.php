<?php

declare(strict_types=1);

namespace PPBot\Service;

use PPBot\Book\Entity\Book;

class BookToSlackMessageConverter
{
    public function convert(Book $book): string
    {
        $messageData = [
            'blocks' => [
                $this->buildTitleBlock(),
                $this->buildInfoBlock($book),
                $this->buildButtonsBlock(),
            ],
        ];

        return json_encode($messageData, JSON_THROW_ON_ERROR | JSON_UNESCAPED_SLASHES,);
    }

    private function buildTitleBlock(): array
    {
        return [
            'type' => 'section',
            'text' => [
                'type' => 'plain_text',
                'text' => "Today's Free eBook:",
            ],
        ];
    }

    private function buildInfoBlock(Book $book): array
    {
        $text = "*{$book->getTitle()}*\n";
        foreach ($book->getAuthors() as $author) {
            $text .= "_{$author->getName()}_\n";
        }
        $text .= "\n\n";
        $text .= "{$book->getPublicationDate()->format('M Y')} \n\n";
        $text .= $book->getDescription();

        return [
            'type' => 'section',
            'text' => [
                'type' => 'mrkdwn',
                'text' => $text,
            ],
            'accessory' => [
                'type' => 'image',
                'image_url' => $book->getCoverURL(),
                'alt_text' => "{$book->getTitle()} book cover"
            ]
        ];
    }

    private function buildButtonsBlock(): array
    {
        return [
            'type' => 'actions',
            'elements' => [
                [
                    'type' => 'button',
                    'text' => [
                        'type' => 'plain_text',
                        'text' => 'Claim Now',
                    ],
                    'style' => 'primary',
                    'url' => 'https://www.packtpub.com/free-learning',
                ],
            ],
        ];
    }
}
