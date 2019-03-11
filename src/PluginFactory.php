<?php
/**
 * Plugin factory.
 *
 * @package   MadeInItalySLC\WP\Plugin
 * @copyright Copyright (c) 2017 Cedaro, LLC
 * @license   MIT
 */

namespace MadeInItalySLC\WP\Plugin;

use MadeInItalySLC\WP\Plugin\Providers\ServiceProvider;
use Psr\Container\ContainerInterface;

if (\class_exists('PluginFactory')) return;

/**
 * Plugin factory class.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
class PluginFactory
{
    /**
     * @param string $slug
     * @param string $filename
     * @param ContainerInterface|null $container
     * @return Plugin
     */
	public static function create(string $slug, string $filename, ContainerInterface $container = null)
	{
		// Use the calling file as the main plugin file.
		if (!$filename) {
			$backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
			$filename = $backtrace[0]['file'];
		}

		if (!$container) {
		    $container = new \League\Container\Container();

		    $container->addServiceProvider(new ServiceProvider($filename, $slug));
        }

		$plugin = (new Plugin())
			->setBasename(plugin_basename($filename))
			->setDirectory(plugin_dir_path($filename))
			->setFile($filename)
			->setSlug($slug)
			->setUrl(plugin_dir_url($filename));

		$plugin->setContainer($container);

		return $plugin;
	}
}
