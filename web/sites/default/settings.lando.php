<?php

// @codingStandardsIgnoreFile

/**
 * @file
 * Local development override configuration feature.
 *
 * To activate this feature, copy and rename it such that its path plus
 * filename is 'sites/default/settings.local.php'. Then, go to the bottom of
 * 'sites/default/settings.php' and uncomment the commented lines that mention
 * 'settings.local.php'.
 *
 * If you are using a site name in the path, such as 'sites/example.com', copy
 * this file to 'sites/example.com/settings.local.php', and uncomment the lines
 * at the bottom of 'sites/example.com/settings.php'.
 */

/**
 * Enable local development services.
 */
$settings['container_yamls'][] = $app_root . '/sites/development.services.yml';

/**
 * Show all error messages, with backtrace information.
 *
 * In case the error level could not be fetched from the database, as for
 * example the database connection failed, we rely only on this value.
 */
$config['system.logging']['error_level'] = 'verbose';

/**
 * Disable CSS and JS aggregation.
 */
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/**
 * Disable the render cache.
 *
 * Note: you should test with the render cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the render cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Only use this setting once the site has been installed.
 */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/**
 * Disable caching for migrations.
 *
 * Uncomment the code below to only store migrations in memory and not in the
 * database. This makes it easier to develop custom migrations.
 */
# $settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/**
 * Disable Internal Page Cache.
 *
 * Note: you should test with Internal Page Cache enabled, to ensure the correct
 * cacheability metadata is present. However, in the early stages of
 * development, you may want to disable it.
 *
 * This setting disables the page cache by using the Null cache back-end
 * defined by the development.services.yml file above.
 *
 * Only use this setting once the site has been installed.
 */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/**
 * Disable Dynamic Page Cache.
 *
 * Note: you should test with Dynamic Page Cache enabled, to ensure the correct
 * cacheability metadata is present (and hence the expected behavior). However,
 * in the early stages of development, you may want to disable it.
 */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/**
 * Allow test modules and themes to be installed.
 *
 * Drupal ignores test modules and themes by default for performance reasons.
 * During development it can be useful to install test extensions for debugging
 * purposes.
 */
# $settings['extension_discovery_scan_tests'] = TRUE;

/**
 * Enable access to rebuild.php.
 *
 * This setting can be enabled to allow Drupal's php and database cached
 * storage to be cleared via the rebuild.php page. Access to this page can also
 * be gained by generating a query string from rebuild_token_calculator.sh and
 * using these parameters in a request to rebuild.php.
 */
$settings['rebuild_access'] = TRUE;

/**
 * Skip file system permissions hardening.
 *
 * The system module will periodically check the permissions of your site's
 * site directory to ensure that it is not writable by the website user. For
 * sites that are managed with a version control system, this can cause problems
 * when files in that directory such as settings.php are updated, because the
 * user pulling in the changes won't have permissions to modify files in the
 * directory.
 */
$settings['skip_permissions_hardening'] = TRUE;

/**
 * Get Lando info
 */
$lando_info = json_decode(getenv('LANDO_INFO'), TRUE);

/**
 * Lando database credentials.
 */
$databases['default']['default'] = array (
  'database' => $lando_info['database']['creds']['database'],
  'username' => $lando_info['database']['creds']['user'],
  'password' => $lando_info['database']['creds']['password'],
  'host' => $lando_info['database']['internal_connection']['host'],
  'port' => $lando_info['database']['internal_connection']['port'],
  'driver' => 'mysql',
  'prefix' => '',
  'collation' => 'utf8mb4_general_ci',
);

/**
 * Error reporting.
 *
 * As a developer it is useful to see all errors. If the site you are working
 * on has a lot of notice errors and you aren't able to fix them you can
 * suppress them by modifying E_ALL in error_reporting to:
 * E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED
 */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

/**
 * Stage file proxy.
 *
 * To use stage file proxy you will need the module enabled. Then uncomment
 * the config line below and edit the domain to suit. If the domain is behind
 * http auth then you can use agile:collective before the @ sign (or whatever
 * user/pass combination you need). Change the domain.org part to match the
 * domain (usually production, sometimes development) with the images.
 */

 // Remove the following line and uncomment the one after the site goes live
//$config['stage_file_proxy.settings']['origin']  = 'https://dev.lcrfs.iied.org';
$config['stage_file_proxy.settings']['origin']  = 'https://www.climateresilience.finance';

/**
 * Use "local" config split for development
 */
$config['config_split.config_split.local']['status'] = TRUE;
$config['config_split.config_split.dev']['status'] = FALSE;
$config['config_split.config_split.stage']['status'] = FALSE;
$config['config_split.config_split.prod']['status'] = FALSE;
