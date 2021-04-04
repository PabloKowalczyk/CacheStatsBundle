<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class PabloKCacheStatsExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container): void
    {
        $directory = \dirname(__DIR__, 2);
        $fileLocator = new FileLocator("{$directory}/config");
        $loader = new Loader\XmlFileLoader($container, $fileLocator);
        $loader->load('services.xml');
    }
}
