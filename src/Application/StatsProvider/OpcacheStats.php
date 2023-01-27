<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class OpcacheStats
{
    public function __construct(
        private bool $enabled,
        private Size $size,
        private Size $usage,
        private Size $internedStringsSize,
        private Size $internedStringsUsage,
        private int $internedStringsNumber,
        private int $scriptSlotsSize,
        private int $scriptSlotsUsage,
        private float $hitRatio
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

    public function internedStringsSize(): Size
    {
        return $this->internedStringsSize;
    }

    public function internedStringsUsage(): Size
    {
        return $this->internedStringsUsage;
    }

    public function internedStringsNumber(): int
    {
        return $this->internedStringsNumber;
    }

    public function scriptSlotsSize(): int
    {
        return $this->scriptSlotsSize;
    }

    public function scriptSlotsUsage(): int
    {
        return $this->scriptSlotsUsage;
    }

    public function hitRatio(): float
    {
        return $this->hitRatio;
    }
}
