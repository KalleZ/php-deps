<?php
	/**
	 *   +----------------------------------------------------------------------+
	 *   | PHP Build Dependencies for Windows                                   |
	 *   +----------------------------------------------------------------------+
	 *   | Copyright (c) 2016 Kalle Sommer Nielsen                              |
	 *   +----------------------------------------------------------------------+
	 *   | This source file is subject to version 3.01 of the PHP license,      |
	 *   | that is bundled with this package in the file LICENSE, and is        |
	 *   | available through the world-wide-web at the following url:           |
	 *   | http://www.php.net/license/3_01.txt                                  |
	 *   | If you did not receive a copy of the PHP license and are unable to   |
	 *   | obtain it through the world-wide-web, please send a note to          |
	 *   | license@php.net so we can mail you a copy immediately.               |
	 *   +----------------------------------------------------------------------+
	 *   | Authors: Kalle Sommer Nielsen <kalle@php.net>                        |
	 *   +----------------------------------------------------------------------+
	 */

	/**
	 * Namespace imports
	 */
	use PHPDeps\CommandlineArguments;


	/**
	 * Backend includes
	 */
	require(__DIR__ . '/includes/functions.php');
	require(__DIR__ . '/includes/version.php');


	/**
	 * Register handlers
	 */
	set_exception_handler('phpdeps_exception_handler');
	spl_autoload_register('phpdeps_autoload_handler');

	/**
	 * This is intended to only ever be executed in CLI
	 */
	if(PHP_SAPI != 'cli')
	{
		throw new Exception('This program should only be used in CLI mode');
	}

	/**
	 * Check for Windows (duh)
	 */
	if(!defined('PHP_WINDOWS_VERSION_MAJOR'))
	{
		throw new Exception('This is not the right tool for you; Upgrade to Windows today!');
	}

	/**
	 * Check for PHP extensions we need
	 */
	foreach(['json', 'zip'] as $ext)
	{
		if(!extension_loaded($ext))
		{
			throw new Exception('The ' . $ext . ' extension for PHP is required');
		}
	}

	/**
	 * Look for php_version.h, we must be in the root of php-src
	 */
	if(!is_file('main/php_version.h'))
	{
		throw new Exception('php_version.h was not found; Try run this again from the root of php-src');
	}

	/**
	 * Load the command line arguments class
	 */
	$cli = new CommandlineArguments;

	$cli->invoke();
?>