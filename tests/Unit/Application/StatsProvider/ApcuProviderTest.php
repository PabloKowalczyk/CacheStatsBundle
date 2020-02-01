<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Tests\Unit\Application\StatsProvider;

use PabloK\CacheStatsBundle\Application\StatsProvider\ApcuProvider;
use PabloK\CacheStatsBundle\Tests\TestCase\UnitTestCase;

final class ApcuProviderTest extends UnitTestCase
{
    public function test_apcu_provider_works_with_extension_enabled(): void
    {
        if (!$this->isApcuEnabled()) {
            $this->markTestSkipped('APCu is not enabled.');
        }

        $apcuProvider = $this->createApcuProvider();
        $apcuStatus = $apcuProvider->provide();
        $memorySize = $apcuStatus->memorySize();
        $memoryUsage = $apcuStatus->memoryUsage();

        $this->assertTrue($apcuStatus->enabled());
        $this->assertGreaterThan(0, $memorySize->asBytes());
        $this->assertGreaterThan(0, $memoryUsage->asBytes());
        $this->assertGreaterThan(0, $apcuStatus->slotsSize());
        $this->assertGreaterThanOrEqual(0, $apcuStatus->slotsUsage());
        $this->assertNotEmpty($apcuStatus->memoryType());
    }

    public function test_apcu_provider_works_with_extension_disabled(): void
    {
        if ($this->isApcuEnabled()) {
            $this->markTestSkipped('APCu is not disabled.');
        }

        $apcuProvider = $this->createApcuProvider();
        $apcuStatus = $apcuProvider->provide();
        $memorySize = $apcuStatus->memorySize();
        $memoryUsage = $apcuStatus->memoryUsage();

        $this->assertFalse($apcuStatus->enabled());
        $this->assertSame(0, $memorySize->asBytes());
        $this->assertSame(0, $memoryUsage->asBytes());
        $this->assertSame(0, $apcuStatus->slotsSize());
        $this->assertSame(0, $apcuStatus->slotsUsage());
        $this->assertEmpty($apcuStatus->memoryType());
    }

    private function isApcuEnabled(): bool
    {
        return \extension_loaded('apcu')
            && \filter_var(\ini_get('apc.enable_cli'), FILTER_VALIDATE_BOOLEAN)
        ;
    }

    private function createApcuProvider(): ApcuProvider
    {
        return new ApcuProvider();
    }
}
