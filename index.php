<?php

/**
 * @file index.php
 *
 * Copyright (c) 2014-2021 Simon Fraser University
 * Copyright (c) 2003-2021 John Willinsky
 * Distributed under the GNU GPL v3. For full terms see the file docs/COPYING.
 *
 * Single entry point for the PKP monorepo.
 * Reads the active application from app_config and bootstraps it.
 */

use APP\core\Application;

define('INDEX_FILE_LOCATION', __FILE__);
define('PKP_APPLICATION', trim(file_get_contents(__DIR__ . '/app_config')));
require_once __DIR__ . '/pkp-lib/includes/bootstrap.php';

Application::get()->execute();
