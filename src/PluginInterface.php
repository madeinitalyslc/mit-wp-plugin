<?php
/**
 * Plugin interface.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @author    John P. Bloch
 * @author    Brady Vercher
 * @link      https://github.com/johnpbloch/wordpress-dev
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

if (\interface_exists('PluginInterface')) return;

/**
 * Plugin interface.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
interface PluginInterface
{
	/**
	 * Retrieve the relative path to the main plugin file from the main plugin
	 * directory.
	 *
	 * @return string
	 */
	public function getBasename();

	/**
	 * Set the plugin basename.
	 *
	 * @param string $basename Relative path from the main plugin directory.
	 * @return $this
	 */
	public function setBasename($basename);

	/**
	 * Retrieve the plugin directory.
	 *
	 * @return string
	 */
	public function getDirectory();

	/**
	 * Set the plugin's directory.
	 *
	 * @param  string $directory Absolute path to the main plugin directory.
	 * @return $this
	 */
	public function setDirectory($directory);

	/**
	 * Retrieve the path to a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function getPath($path = '');

	/**
	 * Retrieve the absolute path for the main plugin file.
	 *
	 * @return string
	 */
	public function getFile();

	/**
	 * Set the path to the main plugin file.
	 *
	 * @param  string $file Absolute path to the main plugin file.
	 * @return $this
	 */
	public function setFile($file);

	/**
	 * Retrieve the plugin identifier.
	 *
	 * @return string
	 */
	public function getSlug();

	/**
	 * Set the plugin identifier.
	 *
	 * @param  string $slug Plugin identifier.
	 * @return $this
	 */
	public function setSlug($slug);

	/**
	 * Retrieve the URL for a file in the plugin.
	 *
	 * @param  string $path Optional. Path relative to the plugin root.
	 * @return string
	 */
	public function getUrl($path = '');

	/**
	 * Set the URL for plugin directory root.
	 *
	 * @param  string $url URL to the root of the plugin directory.
	 * @return $this
	 */
	public function setUrl($url);

	/**
	 * Register hooks for the plugin.
	 *
	 * @param HookProviderInterface $provider Hook provider.
	 */
	public function registerHooks(HookProviderInterface $provider);
}
