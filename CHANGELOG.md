# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

### Removed

- [#9] Drop PHP v7.2 support

### Fixed

- [#10] Add PHP v8 support
- [#11] Fix missing "$hitRation" variable when OPCache is disabled

### Changed

- [#12] Change a red badge of disabled caches to grey

## [v0.2.0] - 2020-02-01

### Added

- [#5] Add Symfony v5.x support

### Fixed

- [#7] Fix CacheStatsDataCollector compatibility with Symfony v5

### Removed

- [#6] Drop Symfony v4.2 support

## [v0.1.1] - 2020-02-01

### Fixed
- [#3] Fix missing `$memoryType` in ApcuProvider

## [v0.1.0] - 2019-07-07
### Added
- Toolbar panel with cache statistics

[Unreleased]: https://github.com/PabloKowalczyk/CacheStatsBundle/compare/v0.1.1...HEAD
[v0.1.0]: https://github.com/PabloKowalczyk/CacheStatsBundle/releases/tag/v0.1.0
[v0.1.1]: https://github.com/PabloKowalczyk/CacheStatsBundle/compare/v0.1.0...v0.1.1
[v0.2.0]: https://github.com/PabloKowalczyk/CacheStatsBundle/compare/v0.1.1...v0.2.0
[#3]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/3
[#5]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/5
[#6]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/6
[#7]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/7
[#9]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/9
[#10]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/10
[#11]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/11
[#12]: https://github.com/PabloKowalczyk/CacheStatsBundle/pull/12
