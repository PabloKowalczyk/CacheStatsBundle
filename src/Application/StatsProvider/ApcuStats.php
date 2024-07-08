<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class ApcuStats
{
    public function __construct(
        public readonly bool $enabled,
        public readonly int $slotsSize,
        public readonly int $slotsUsage,
        public readonly Size $memorySize,
        public readonly Size $memoryUsage,
        public readonly string $memoryType,
    ) {
    }
}
