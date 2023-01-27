<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class ApcuStats
{
    public function __construct(
        private bool $enabled,
        private int $slotsSize,
        private int $slotsUsage,
        private Size $memorySize,
        private Size $memoryUsage,
        private string $memoryType,
    ) {
    }

    public function enabled(): bool
    {
        return $this->enabled;
    }

    public function slotsSize(): int
    {
        return $this->slotsSize;
    }

    public function slotsUsage(): int
    {
        return $this->slotsUsage;
    }

    public function memorySize(): Size
    {
        return $this->memorySize;
    }

    public function memoryUsage(): Size
    {
        return $this->memoryUsage;
    }

    public function memoryType(): string
    {
        return $this->memoryType;
    }
}
