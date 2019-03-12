<?php

/**
 * Plugin interface.
 *
 * @author John P. Bloch
 * @author Brady Vercher
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 *
 * @see https://github.com/johnpbloch/wordpress-dev
 *
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

if (\interface_exists('PluginInterface')) {
    return;
}

/**
 * Plugin interface.
 */
interface PluginInterface
{
    /**
     * Retrieve the relative path to the main plugin file from the main plugin
     * directory.
     *
     * @return string
     *
     * @deprecated
     */
    public function getBasename();

    /**
     * Set the plugin basename.
     *
     * @param string $basename relative path from the main plugin directory
     *
     * @return $this
     */
    public function setBasename($basename);

    /**
     * Retrieve the plugin directory.
     *
     * @return string
     *
     * @deprecated
     */
    public function getDirectory();

    /**
     * Set the plugin's directory.
     *
     * @param string $directory absolute path to the main plugin directory
     *
     * @return $this
     */
    public function setDirectory($directory);

    /**
     * Retrieve the path to a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     *
     * @return string
     */
    public function getPath($path = '');

    /**
     * Retrieve the absolute path for the main plugin file.
     *
     * @return string
     *
     * @deprecated
     */
    public function getFile();

    /**
     * Set the path to the main plugin file.
     *
     * @param string $file absolute path to the main plugin file
     *
     * @return $this
     */
    public function setFile($file);

    /**
     * Retrieve the plugin identifier.
     *
     * @return string
     *
     * @deprecated
     */
    public function getSlug();

    /**
     * Set the plugin identifier.
     *
     * @param string $slug plugin identifier
     *
     * @return $this
     */
    public function setSlug($slug);

    /**
     * Retrieve the URL for a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     *
     * @return string
     *
     * @deprecated
     */
    public function getUrl($path = '');

    /**
     * Set the URL for plugin directory root.
     *
     * @param string $url URL to the root of the plugin directory
     *
     * @return $this
     */
    public function setUrl($url);

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion(string $version);

    /**
     * @return string
     *
     * @deprecated
     */
    public function getVersion();

    /**
     * Register hooks for the plugin.
     *
     * @param HookProviderInterface $provider hook provider
     */
    public function registerHooks(HookProviderInterface $provider);
}
