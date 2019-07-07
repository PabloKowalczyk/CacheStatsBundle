<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\DataCollector;

use PabloK\CacheStatsBundle\Application\StatsProvider\ApcuProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\ApcuStats;
use PabloK\CacheStatsBundle\Application\StatsProvider\OpcacheProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\OpcacheStats;
use PabloK\CacheStatsBundle\Application\StatsProvider\RealPathProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\RealPathStats;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

final class CacheStatsDataCollector extends DataCollector
{
    private const REAL_PATH_KEY = 'realpath';
    private const OPCACHE_KEY = 'opcache';
    private const APCU_KEY = 'apcu';

    /** @var RealPathProvider */
    private $realPathProvider;
    /** @var OpcacheProvider */
    private $opcacheProvider;
    /** @var ApcuProvider */
    private $apcuProvider;

    public function __construct(
        RealPathProvider $realPathProvider,
        OpcacheProvider $opcacheProvider,
        ApcuProvider $apcuProvider
    ) {
        $this->realPathProvider = $realPathProvider;
        $this->opcacheProvider = $opcacheProvider;
        $this->apcuProvider = $apcuProvider;
    }

    /** @inheritDoc */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $this->data[self::REAL_PATH_KEY] = $this->realPathProvider
            ->provide();
        $this->data[self::OPCACHE_KEY] = $this->opcacheProvider
            ->provide();
        $this->data[self::APCU_KEY] = $this->apcuProvider
            ->provide();
    }

    /** @inheritDoc */
    public function getName()
    {
        return 'pablok.cache_stats_bundle.cache_stats_collector';
    }

    public function reset()
    {
        $this->data = [];
    }

    public function realPathStats(): RealPathStats
    {
        return $this->data[self::REAL_PATH_KEY];
    }

    public function opcacheStats(): OpcacheStats
    {
        return $this->data[self::OPCACHE_KEY];
    }

    public function apcuStats(): ApcuStats
    {
        return $this->data[self::APCU_KEY];
    }
}
