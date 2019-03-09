<?php
/**
 * Plugin factory.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

/**
 * Plugin factory class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
class PluginFactory
{
	/**
	 * Create a plugin instance.
	 *
	 * @param string $slug     Plugin slug.
	 * @param string $filename Optional. Absolute path to the main plugin file.
	 *                         This should be passed if the calling file is not
	 *                         the main plugin file.
	 * @return Plugin Plugin instance.
	 */
	public static function create($slug, $filename = '')
	{
		// Use the calling file as the main plugin file.
		if (empty($filename)) {
			$backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
			$filename = $backtrace[0]['file'];
		}

		return (new Plugin())
			->setBasename(plugin_basename($filename))
			->setDirectory(plugin_dir_path($filename))
			->setFile($filename)
			->setSlug($slug)
			->setUrl(plugin_dir_url($filename));
	}
}
