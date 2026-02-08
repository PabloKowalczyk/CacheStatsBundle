<?php

use PabloK\CacheStatsBundle\Application\StatsProvider\ApcuProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\JitProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\OpcacheProvider;
use PabloK\CacheStatsBundle\Application\StatsProvider\RealPathProvider;
use PabloK\CacheStatsBundle\DataCollector\CacheStatsDataCollector;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function(ContainerConfigurator $container): void {
    $services = $container->services();

    $services->set(RealPathProvider::class);
    $services->set(OpcacheProvider::class);
    $services->set(ApcuProvider::class);
    $services->set(JitProvider::class);

    $services->set(CacheStatsDataCollector::class)
        ->args(
            [
                service(RealPathProvider::class),
                service(OpcacheProvider::class),
                service(ApcuProvider::class),
                service(JitProvider::class),
            ],
        )
        ->tag(
            'data_collector',
            [
                'id' => 'pablok.cache_stats_bundle.cache_stats_collector',
                'template' => '@PabloKCacheStats/cache_stats',
                'priority' => -300,
            ]
        )
    ;
};
