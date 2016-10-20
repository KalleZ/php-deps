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
	 * Exception handler
	 *
	 * @param	\Throwable				The exception to handle
	 * @return	void					No value is returned
	 *
	 * @note	Halts the execution
	 */
	function phpdeps_exception_handler(Throwable $e)
	{
		printf('Error:%1$s%2$s%1$s', PHP_EOL, $e->getMessage());

		exit(-1);
	}

	/**
	 * Autoload handler
	 *
	 * @param	string					The class/interface/trait to load
	 * @return	void					No value is returned
	 *
	 * @throws	\Exception				Throws an exception if the object could not be found
	 */
	function phpdeps_autoload_handler($object)
	{
		$path = __DIR__ . '\library\\' . $object . '.php';

		if(!is_file($path))
		{
			throw new Exception('Could not find file for object: ' . $object);
		}

		require($path);

		if(!class_exists($object) && !interface_exists($object) && !trait_exists($object))
		{
			throw new Exception('Could not find object implementation in file: ' . $path);
		}
	}
?>