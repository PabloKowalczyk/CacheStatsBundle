<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class JitStats
{
    private bool $enabled;
    private Size $bufferSize;
    private Size $bufferUsage;

    public function __construct(
        bool $enabled,
        Size $bufferSize,
        Size $bufferFree
    ) {
        $this->enabled = $enabled;
        $this->bufferSize = $bufferSize;
        $this->bufferUsage = $bufferSize->subtract($bufferFree);
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function bufferSize(): Size
    {
        return $this->bufferSize;
    }

    public function bufferUsage(): Size
    {
        return $this->bufferUsage;
    }
}
