<?php
/**
 * Hook provider interface.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

/**
 * Hook provider interface.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
interface HookProviderInterface
{
	/**
	 * Registers hooks for the plugin.
	 */
	public function registerHooks();
}
