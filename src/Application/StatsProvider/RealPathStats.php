<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class RealPathStats
{
    public function __construct(
        private bool $enabled,
        private Size $size,
        private Size $usage,
    ) {
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function size(): Size
    {
        return $this->size;
    }

    public function usage(): Size
    {
        return $this->usage;
    }
}
