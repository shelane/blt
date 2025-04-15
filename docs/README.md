# BLT

## End of One Life to an Extended Life

Acquia has announced the end of life for BLT effective July 1, 2024. For more details, see https://github.com/acquia/blt/issues/4736.
This repository is an extension of the Acquia BLT repository. There were necessary changes for Drupal 10 users that were
never released. This repository is a fork of the Acquia BLT repository and is not supported by Acquia and is offered
without warranty.

## Overview

![BLT logo of stylized sandwich](https://github.com/acquia/blt/raw/11.x/docs/_static/blt-logo.png)

![Build Status](https://github.com/acquia/blt/actions/workflows/orca.yml/badge.svg?main) [![Packagist](https://img.shields.io/packagist/v/shelane/blt.svg)](https://packagist.org/packages/shelane/blt)

BLT (Build and Launch Tool) provides an automation layer for testing, building, and launching Drupal 8 and 9 applications.

**To learn more and get started, see the documentation: https://docs.acquia.com/blt**

**To review the Acquia and community provided plugins for BLT, see the [plugin registry](https://support-acquia.force.com/s/article/360046918614-Acquia-BLT-Plugins).**

## BLT Versions

| BLT Version | Supported? | Major Drupal Version | PHP Version     | Drush Version |
|-------------|------------|----------------------|-----------------|---------------|
| 14.x        | Yes        | 10.x                 | 8.1, 8.2, 8.3 * | 12.x, 13.x *  |
| 13.x        | **No**     | 9.x, 10.x            | 8.0, 8.1, 8.2 * | 11.x, 12.x *  |
| 12.x        | **No**     | 9.x                  | 7.4             | 10.x          |
| 11.x        | **No**     | 8.x                  | 7.4             | 9.x, 10.x     |

\* BLT users must upgrade to at least BLT 14.0.0 to upgrade to PHP 8.3. and Drush 13 (or beyond).

PHP 8.4 is untested. Drupal 11 is not supported.

## Steps to use Acquia Drupal Recommended Settings with BLT.

- Update the BLT plugin to the latest release, which includes acquia/drupal-recommended-settings OOTB.
```
composer update shelane/blt -W
```

### Manual Process:

- Remove BLT reference from settings.php file located at `/docroot/sites/<site-name>/settings.php`.
```diff
- require DRUPAL_ROOT . "/../vendor/shelane/blt/settings/blt.settings.php";
- /**
-  * IMPORTANT.
-  *
-  * Do not include additional settings here. Instead, add them to settings
-  * included by `blt.settings.php`. See BLT's documentation for more detail.
-  *
-  * @link https://docs.acquia.com/blt/
-  */
+ require DRUPAL_ROOT . "/../vendor/acquia/drupal-recommended-settings/settings/acquia-recommended.settings.php";
+ /**
+  * IMPORTANT.
+  *
+  * Do not include additional settings here. Instead, add them to settings
+  * included by `acquia-recommended.settings.php`. See Acquia's documentation for more detail.
+  *
+  * @link https://docs.acquia.com/
+  */
```

- Update `default.local.settings.php` and `local.settings.php` to use the
  Environment Detector provided by this DSR plugin instead of BLT:
```diff
- use Acquia\Blt\Robo\Common\EnvironmentDetector;
+ use Acquia\Drupal\RecommendedSettings\Helpers\EnvironmentDetector;
```

### Automated Process:
- Use migrate command provided in BLT.
```
./vendor/bin/blt blt:migrate
```

# License

Copyright (C) 2020 Acquia, Inc.

This program is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License version 2 as published by the Free Software Foundation.

This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
