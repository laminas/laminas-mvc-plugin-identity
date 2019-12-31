# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.1.1 - 2019-10-18

### Added

- [zendframework/zend-mvc-plugin-identity#12](https://github.com/zendframework/zend-mvc-plugin-identity/pull/12) adds support for PHP 7.3.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.1.0 - 2018-04-30

### Added

- [zendframework/zend-mvc-plugin-identity#11](https://github.com/zendframework/zend-mvc-plugin-identity/pull/11) adds support for PHP 7.1 and 7.2.

### Changed

- [zendframework/zend-mvc-plugin-identity#9](https://github.com/zendframework/zend-mvc-plugin-identity/pull/9) modifies the `IdentityFactory` such that it will attempt to lookup the
  `Laminas\Authentication\AuthenticationServiceInterface` service if no `Laminas\Authentication\AuthenticationService`
  service is present in the container, and use it to seed the `Identity` plugin if found.

### Deprecated

- Nothing.

### Removed

- [zendframework/zend-mvc-plugin-identity#11](https://github.com/zendframework/zend-mvc-plugin-identity/pull/11) removes support for HHVM.

### Fixed

- Nothing.

## 1.0.0 - 2016-05-31

First stable release.

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [zendframework/zend-mvc-plugin-identity#3](https://github.com/zendframework/zend-mvc-plugin-identity/pull/3)
  updates the minimum PHP version to 5.6.
- [zendframework/zend-mvc-plugin-identity#3](https://github.com/zendframework/zend-mvc-plugin-identity/pull/3)
  pins the component to laminas-mvc 3.0 stable, and marks v2 releases as conflicts.

## 0.1.0 - 2016-03-29

First (stable) release.

This component replaces the `Identity` (aka `identity()`) plugin from
laminas-mvc, for use with upcoming v3 of that component. Once that stable release
is made, we will issue a 1.0.0 release removing the `dev-develop as 3.0.0`
laminas-mvc constraint.

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
