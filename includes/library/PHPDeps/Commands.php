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
	 * Strict types
	 */
	declare(strict_types = 1);


	/**
	 * @todo	Docblock
	 */
	namespace PHPDeps;


	/**
	 * @todo	Docblock
	 */
	class Commands
	{
		/**
		 * @todo	Docblock
		 * @todo	Implement
		 */
		public static function help(array $parameters = NULL)
		{
		}

		/**
		 * Prints the version number
		 *
		 * @param	array				The parameters sent to this command (not used)
		 * @return	void				No value is returned
		 */
		public static function version(array $parameters = NULL)
		{
			echo('Version: ' . PHPDEPS_VERSION_FULL);
		}
	}
?>