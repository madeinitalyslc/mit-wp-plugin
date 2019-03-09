<?php
/**
 * Plugin aware interface.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

/**
 * Plugin aware interface.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
interface PluginAwareInterface
{
	/**
	 * Set the main plugin instance.
	 *
	 * @param  PluginInterface $plugin Main plugin instance.
	 * @return $this
	 */
	public function setPlugin(PluginInterface $plugin);

	/**
	 * Get the main plugin instance.
	 *
	 * @return PluginInterface
	 */
	public function getPlugin();
}
