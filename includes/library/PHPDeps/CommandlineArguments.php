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
	 * Namespace
	 */
	namespace PHPDeps;


	/**
	 * @todo	Docblock
	 */
	class CommandlineArguments
	{
		/**
		 * The command currently being executed
		 *
		 * @var		string
		 */
		protected $command		= '';

		/**
		 * The parameters sent to the command
		 *
		 * @var		string[]
		 */
		protected $parameters		= [];

		/**
		 * Default command handlers
		 *
		 * @var		callable[]
		 */
		protected $handlers		= [];


		/**
		 * Constructor
		 *
		 * Constructs a new command line argument object for PHP Deps and 
		 * does some initial checks
		 *
		 * @throws	\Exception				Throws an exception if the object could not be found
		 */
		public function __construct()
		{
			/**
			 * Test if there is anything to do
			 */
			if($_SERVER['argc'] === 1)
			{
				throw new \Exception('Nothing to do');
			}

			/**
			 * Parse the arguments, the first one is the command, anything else is values sent 
			 * to that command, such as:
			 *
			 * php-deps option name value
			 */
			$this->command 	= \strtolower($_SERVER['argv'][1]);

			if($_SERVER['argc'] > 2)
			{
				/**
				 * Copy to not modify the actual $_SERVER['argv'] array
				 */
				$argv 		= $_SERVER['argv'];

				\array_shift($argv);
				\array_shift($argv);

				$this->parameters = $argv;
			}
		}

		/**
		 * Gets the current command
		 *
		 * @return	string					Returns the current command
		 */
		public function getCommand() : string
		{
			return($this->command);
		}

		/**
		 * Gets the current parameters (if any) for a command
		 *
		 * @return	string[]				Returns an array of strings, or an empty array if no parameters are sent
		 */
		public function getParameters() : array
		{
			return($this->parameters);
		}

		/**
		 * Registers a new handler
		 *
		 * @param	string					The command to register a handler for
		 * @param	callable				The callable handler for this command
		 * @return	void					No value is returned
		 *
		 * @note	This will override any previous handlers for a command
		 */
		public function handle(string $command, callable $handler)
		{
			$this->handlers[\strtolower($command)] = $handler;
		}

		/**
		 * Invokes the command handler
		 *
		 * This method can be used to manually invoke a handler by calling it with its two
		 * parameters.
		 *
		 * @param	string					(Optional) The name of the command to run
		 * @param	string[]				(Optional) An array of strings to pass as parameters
		 * @return	void					No value is returned
		 *
		 * @throws	\Exception				Throws an exception if there is no handlers registered for a command
		 */
		public function invoke(string $command = NULL, array $parameters = [])
		{
			if(!isset($this->handlers[$command = (func_num_args() === 2 ? $command : $this->command)]))
			{
				throw new \Exception('Invalid command: \'' . $command . '\'');
			}

			$this->handlers[$command](... (func_num_args() === 2 ? $parameters : $this->parameters));
		}
	}
?>