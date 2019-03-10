<?php
/**
 * Internationalization provider.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin\Hooks;

use MadeInItalySLC\WP\Plugin\HookProviderInterface;
use MadeInItalySLC\WP\Plugin\HooksTrait;
use MadeInItalySLC\WP\Plugin\PluginAwareInterface;
use MadeInItalySLC\WP\Plugin\PluginAwareTrait;

if (\class_exists('I18n')) return;

/**
 * Class I18n
 *
 * @package MadeInItalySLC\WP\Plugin\Hooks
 */
class I18n implements PluginAwareInterface, HookProviderInterface
{
	use HooksTrait, PluginAwareTrait;

	/**
	 * Register hooks.
	 *
	 * Loads the text domain during the `plugins_loaded` action.
	 */
	public function registerHooks()
	{
		if (did_action('plugins_loaded')) {
			$this->loadTextDomain();
		} else {
			$this->addAction('plugins_loaded', 'loadTextDomain');
		}
	}

	/**
	 * Load the text domain to localize the plugin.
	 */
	protected function loadTextDomain()
	{
		$plugin_rel_path = dirname($this->getPlugin()->getBasename()) . '/languages';

		load_plugin_textdomain($this->getPlugin()->getSlug(), false, $plugin_rel_path);
	}
}
