<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class JitStats
{
    public readonly Size $bufferUsage;

    public function __construct(
        public readonly bool $enabled,
        public readonly Size $bufferSize,
        Size $bufferFree,
    ) {
        $this->bufferUsage = $bufferSize->subtract($bufferFree);
    }
}
