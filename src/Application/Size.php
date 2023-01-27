<?php

declare(strict_types=1);

namespace PabloK\CacheStatsBundle\Application;

final class Size
{
    private const MEGABYTE_IN_BYTES = 1024 ** 2;

    private function __construct(private int $sizeInBytes)
    {
    }

    public static function fromBytes(int $bytes): self
    {
        return new self($bytes);
    }

    public static function nullSize(): self
    {
        return new self(0);
    }

    public static function fromMegabytes(int $megabytes): self
    {
        return new self($megabytes * self::MEGABYTE_IN_BYTES);
    }

    public static function fromPhpIni(string $value): self
    {
        $value = \trim($value);

        if (\is_numeric($value)) {
            return new self((int) $value);
        }

        $last = \strtolower($value[\strlen($value) - 1]);
        $value = \substr(
            $value,
            0,
            -1
        );

        switch ($last) {
            case 'g':
                $value *= 1024;
                // no-break
            case 'm':
                $value *= 1024;
                // no-break
            case 'k':
                $value *= 1024;
        }

        return new self((int) $value);
    }

    public function asBytes(): int
    {
        return $this->sizeInBytes;
    }

    public function asMegabytes(int $precision = 2): float
    {
        return \round($this->sizeInBytes / self::MEGABYTE_IN_BYTES, $precision);
    }

    public function subtract(Size $availableMemory): Size
    {
        $bytes = $this->sizeInBytes - $availableMemory->sizeInBytes;

        return new self($bytes);
    }
}
