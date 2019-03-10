<?php
/**
 * Symfony Var Dump Server provider.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin\Provider;

use MadeInItalySLC\WP\Plugin\HookProviderInterface;
use MadeInItalySLC\WP\Plugin\HooksTrait;
use MadeInItalySLC\WP\Plugin\PluginAwareInterface;
use MadeInItalySLC\WP\Plugin\PluginAwareTrait;

if (\class_exists('VarDumperServer')) return;

/**
 * Var Dump Server class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
class VarDumpServer implements PluginAwareInterface, HookProviderInterface
{
	use HooksTrait, PluginAwareTrait;

	/**
	 * Register hooks.
	 *
	 * Loads the var dump server during the `plugins_loaded` action.
	 */
	public function registerHooks()
	{
		if (did_action('plugins_loaded')) {
			$this->loadVarDumpServer();
		} else {
			$this->addAction('plugins_loaded', 'loadVarDumpServer');
		}
	}

	/**
	 * Load the var dump server environment.
	 */
	protected function loadVarDumpServer()
	{
		$cloner  = new \Symfony\Component\VarDumper\Cloner\VarCloner();
		$fallbackDumper = \in_array(\PHP_SAPI, array('cli', 'phpdbg')) ? new \Symfony\Component\VarDumper\Dumper\CliDumper() : new \Symfony\Component\VarDumper\Dumper\HtmlDumper();

		$dumper = new \Symfony\Component\VarDumper\Dumper\ServerDumper('tcp://127.0.0.1:9912', $fallbackDumper, [
			'cli' => new \Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider(),
			'source' => new \Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider(),
		]);

		\Symfony\Component\VarDumper\VarDumper::setHandler(function ($var) use ($cloner, $dumper) {
			$dumper->dump($cloner->cloneVar($var));
		});
	}
}
