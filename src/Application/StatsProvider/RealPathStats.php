<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class RealPathStats
{
    public function __construct(
        public readonly bool $enabled,
        public readonly Size $size,
        public readonly Size $usage,
    ) {
    }
}
