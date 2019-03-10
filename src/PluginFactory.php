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
use Pimple\Container as PimpleContainer;
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
     * @param ContainerInterface|null $container
     * @param string|null $filename
     * @return Plugin
     */
	public static function create(string $slug, ContainerInterface $container = null, string $filename = null)
	{
		// Use the calling file as the main plugin file.
		if (!$filename) {
			$backtrace = debug_backtrace(DEBUG_BACKTRACE_PROVIDE_OBJECT, 1);
			$filename = $backtrace[0]['file'];
		}

		if (!$container) {
			$container = new PimpleContainer();
		}

		$container['plugin.basename'] = $container->singleton(function (ContainerInterface $container) use ($filename) {
			return plugin_basename($filename);
		});

		$container['plugin.directory'] = $container->singleton(function (ContainerInterface $container) use ($filename) {
			return plugin_dir_path($filename);
		});

		$container['plugin.file'] = $container->singleton(function (ContainerInterface $container) use ($filename) {
			return $filename;
		});

		$container['plugin.slug'] = $container->singleton(function (ContainerInterface $container) use ($slug) {
			return $slug;
		});

		$container['plugin.url'] = $container->singleton(function (ContainerInterface $container) use ($filename) {
			return plugin_dir_url($filename);
		});

		if ($container instanceof PimpleContainer) {
			$container->register(new ServiceProvider());
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
