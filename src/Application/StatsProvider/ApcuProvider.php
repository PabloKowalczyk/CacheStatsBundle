<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class ApcuProvider
{
    public function provide(): ApcuStats
    {
        $iniName = \PHP_SAPI === 'cli'
            ? 'apc.enable_cli'
            : 'apc.enabled'
        ;
        $enabled = \extension_loaded('apcu') && \filter_var(\ini_get($iniName), FILTER_VALIDATE_BOOLEAN);
        $slotsSize = 0;
        $slotsUsage = 0;
        $memorySize = Size::nullSize();
        $memoryUsage = Size::nullSize();
        $memoryType = '';

        if ($enabled) {
            $cacheStats = \apcu_cache_info(true);
            $smaInfo = \apcu_sma_info(true);
            $slotsSize = $cacheStats['num_slots'] ?? 0;
            $slotsUsage = $cacheStats['num_entries']  ?? 0;
            $memorySize = Size::fromBytes((int) ( $smaInfo['seg_size'] ?? 0));
            $availableMemory = Size::fromBytes((int) ($smaInfo['avail_mem'] ?? 0));
            $memoryUsage = $memorySize->subtract($availableMemory);
            $memoryType = $cacheStats['memory_type'] ?? '';
        }

        return new ApcuStats(
            $enabled,
            $slotsSize,
            $slotsUsage,
            $memorySize,
            $memoryUsage,
            $memoryType
        );
    }
}
