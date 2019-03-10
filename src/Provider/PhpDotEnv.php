<?php
/**
 * PHP Dot Env provider.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin\Provider;

use Dotenv\Dotenv;
use MadeInItalySLC\WP\Plugin\HookProviderInterface;
use MadeInItalySLC\WP\Plugin\HooksTrait;
use MadeInItalySLC\WP\Plugin\PluginAwareInterface;
use MadeInItalySLC\WP\Plugin\PluginAwareTrait;

if (\class_exists('PhpDotEnv')) return;

/**
 * PHP Dot Env class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
class PhpDotEnv implements PluginAwareInterface, HookProviderInterface
{
	use HooksTrait, PluginAwareTrait;

	/**
	 * Register hooks.
	 *
	 * Loads the php dot env during the `plugins_loaded` action.
	 */
	public function registerHooks()
	{
		if (did_action('plugins_loaded')) {
			$this->load();
		} else {
			$this->addAction('plugins_loaded', 'load');
		}
	}

	/**
	 * Load the PHP Dot Env.
	 */
	protected function load()
	{
	    Dotenv::create($this->getPlugin()->getDirectory())->load();
	}
}
