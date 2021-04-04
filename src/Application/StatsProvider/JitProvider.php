<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class JitProvider
{
    public function provide(): JitStats
    {
        $opcacheEnabled = \filter_var(\ini_get('opcache.enable'), \FILTER_VALIDATE_BOOLEAN);
        $jitEnabled = false;
        $jitOn = false;
        $bufferSize = Size::nullSize();
        $bufferFree = Size::nullSize();

        if ($opcacheEnabled) {
            $jitStatus = \opcache_get_status(false)['jit'] ?? [];
            $jitEnabled = \filter_var($jitStatus['enabled'] ?? false, \FILTER_VALIDATE_BOOLEAN);
            $jitOn = \filter_var($jitStatus['on'] ?? false, \FILTER_VALIDATE_BOOLEAN);

            if ($jitEnabled && $jitOn) {
                $bufferSize = Size::fromBytes($jitStatus['buffer_size'] ?? 0);
                $bufferFree = Size::fromBytes($jitStatus['buffer_free'] ?? 0);
            }
        }

        return new JitStats(
            $jitEnabled && $jitOn,
            $bufferSize,
            $bufferFree,
        );
    }
}
