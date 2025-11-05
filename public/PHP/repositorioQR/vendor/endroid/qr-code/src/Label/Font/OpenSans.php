<?php

declare(strict_types=1);

namespace Endroid\QrCode\Label\Font;

final readonly class OpenSans implements FontInterface
{
    public function __construct(
        private int $size = 16,
    ) {
    }

    

    public function getPath(): string
    {
        $path = realpath(__DIR__.'/../../../assets/open_sans.ttf');
        return $path;
    }

    public function getSize(): int
    {
        return $this->size;
    }}
