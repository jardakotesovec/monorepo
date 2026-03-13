<?php

/**
 * @defgroup index Index
 * Bootstrap and initialization code.
 */

/**
 * @file includes/bootstrap.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2000-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * @ingroup index
 *
 * @brief Core system initialization code.
 * This file is loaded before any others.
 * Any system-wide imports or initialization code should be placed here.
 */


/**
 * Basic initialization (pre-classloading).
 */

// Load Composer autoloader
$loader = require_once __DIR__ . '/../lib/vendor/autoload.php';

// In monorepo mode, PKP_APPLICATION is defined by the root index.php.
// BASE_SYS_DIR points to the app subdirectory so all existing path resolution works unchanged.
if (defined('PKP_APPLICATION')) {
    define('BASE_SYS_DIR', dirname(INDEX_FILE_LOCATION) . '/' . PKP_APPLICATION);
} else {
    define('BASE_SYS_DIR', dirname(INDEX_FILE_LOCATION));
}
chdir(BASE_SYS_DIR);

// Register APP\\ namespace paths dynamically using Composer's own optimized ClassLoader.
// Same hash-indexed prefix lookup, missing-class cache, and APCu support
// as static composer autoload — zero performance difference.
if (defined('PKP_APPLICATION')) {
    $loader->addPsr4('APP\\controllers\\', BASE_SYS_DIR . '/controllers/');
    $loader->addPsr4('APP\\pages\\',       BASE_SYS_DIR . '/pages/');
    $loader->addPsr4('APP\\API\\',         BASE_SYS_DIR . '/api/');
    $loader->addPsr4('APP\\plugins\\',     BASE_SYS_DIR . '/plugins/');
    $loader->addPsr4('APP\\jobs\\',        BASE_SYS_DIR . '/jobs/');
    $loader->addPsr4('APP\\tests\\',       BASE_SYS_DIR . '/tests/');
    $loader->addPsr4('APP\\',              BASE_SYS_DIR . '/classes/');
}

// System-wide functions
require_once __DIR__ . '/functions.php';

// Initialize the application environment
return new \APP\core\Application();
