<?php
/**
 * Base hook provider.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

if (\class_exists('AbstractHookProvider')) return;

/**
 * Base hook provider class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
abstract class AbstractHookProvider implements HookProviderInterface, PluginAwareInterface
{
	use HooksTrait, PluginAwareTrait;

	/**
	 * Registers hooks for the plugin.
	 */
	abstract public function registerHooks();
}
