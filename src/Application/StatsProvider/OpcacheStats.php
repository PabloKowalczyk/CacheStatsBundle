<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class OpcacheStats
{
    public function __construct(
        public readonly bool $enabled,
        public readonly Size $size,
        public readonly Size $usage,
        public readonly Size $internedStringsSize,
        public readonly Size $internedStringsUsage,
        public readonly int $internedStringsNumber,
        public readonly int $scriptSlotsSize,
        public readonly int $scriptSlotsUsage,
        public readonly float $hitRatio
    ) {
    }
}
