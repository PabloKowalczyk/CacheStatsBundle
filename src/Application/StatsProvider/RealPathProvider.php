<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\Size;

final class RealPathProvider
{
    public function provide(): RealPathStats
    {
        $openBaseDirEnabled = \filter_var(\ini_get('open_basedir'), FILTER_VALIDATE_BOOLEAN);
        $size = Size::fromPhpIni(\ini_get('realpath_cache_size'));
        $usage = Size::fromBytes(\realpath_cache_size());
        $realPathCacheEnabled = !($openBaseDirEnabled || $size->asBytes() === 0);

        return new RealPathStats(
            $realPathCacheEnabled,
            $size,
            $usage
        );
    }
}
