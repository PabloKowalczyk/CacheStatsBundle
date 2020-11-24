<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class OpcacheProvider
{
    public function provide(): OpcacheStats
    {
        $opcacheEnabled = \filter_var(\ini_get('opcache.enable'), \FILTER_VALIDATE_BOOLEAN);
        $size = Size::nullSize();
        $usage = Size::nullSize();
        $internedStringSize = Size::nullSize();
        $internedStringUsage = Size::nullSize();
        $internedStringNumber = 0;
        $scriptSlotsSize = 0;
        $scriptSlotsUsage = 0;
        $hitRatio = 0.0;

        if ($opcacheEnabled) {
            $opcacheStatus = \opcache_get_status(false);
            $size = Size::fromMegabytes((int) \ini_get('opcache.memory_consumption'));
            $usage = Size::fromBytes($opcacheStatus['memory_usage']['used_memory'] ?? 0);
            $internedStringSize = Size::fromMegabytes((int) \ini_get('opcache.interned_strings_buffer'));
            $internedStringUsage = Size::fromBytes($opcacheStatus['interned_strings_usage']['used_memory'] ?? 0);
            $internedStringNumber = $opcacheStatus['interned_strings_usage']['number_of_strings'] ?? 0;
            $scriptSlotsSize = $opcacheStatus['opcache_statistics']['max_cached_keys'] ?? 0;
            $scriptSlotsUsage = $opcacheStatus['opcache_statistics']['num_cached_keys'] ?? 0;
            $hitRatio = $opcacheStatus['opcache_statistics']['opcache_hit_rate'] ?? 0.0;
        }

        return new OpcacheStats(
            $opcacheEnabled,
            $size,
            $usage,
            $internedStringSize,
            $internedStringUsage,
            $internedStringNumber,
            $scriptSlotsSize,
            $scriptSlotsUsage,
            $hitRatio
        );
    }
}
