<?php
/**
 * Basic implementation of PluginAwareInterface.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

if (\trait_exists('PluginAwareTrait', true)) return;

/**
 * Plugin aware trait.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
trait PluginAwareTrait
{
	/**
	 * Main plugin instance.
	 *
	 * @var PluginInterface
	 */
	protected $plugin;

	/**
	 * Set the main plugin instance.
	 *
	 * @param  PluginInterface $plugin Main plugin instance.
	 * @return $this
	 */
	public function setPlugin(PluginInterface $plugin)
	{
		$this->plugin = $plugin;

		return $this;
	}

	/**
	 * Return the main plugin instance
	 *
	 * @return PluginInterface
	 */
	public function getPlugin(): PluginInterface
	{
		return $this->plugin;
	}
}
