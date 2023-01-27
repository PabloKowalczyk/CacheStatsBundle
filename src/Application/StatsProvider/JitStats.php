<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class JitStats
{
    private Size $bufferUsage;

    public function __construct(
        private bool $enabled,
        private Size $bufferSize,
        Size $bufferFree,
    ) {
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
