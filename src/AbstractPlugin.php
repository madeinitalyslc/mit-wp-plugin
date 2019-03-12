<?php
/**
 * Common plugin functionality.
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

use Pimple\Container;
use Psr\Container\ContainerInterface;

if (\class_exists('AbstractPlugin')) {
    return;
}

/**
 * Base plugin class.
 */
abstract class AbstractPlugin extends Container implements PluginInterface, ContainerInterface
{
    /**
     * Plugin basename.
     *
     * Ex: plugin-name/plugin-name.php
     *
     * @var string
     */
    protected $basename;

    /**
     * Absolute path to the main plugin directory.
     *
     * @var string
     */
    protected $directory;

    /**
     * Absolute path to the main plugin file.
     *
     * @var string
     */
    protected $file;

    /**
     * Plugin identifier.
     *
     * @var string
     */
    protected $slug;

    /**
     * URL to the main plugin directory.
     *
     * @var string
     */
    protected $url;

    /**
     * Version of the plugin.
     *
     * @var string
     */
    protected $version;

    /**
     * Retrieve the absolute path for the main plugin file.
     *
     * @return string
     */
    public function getBasename()
    {
        return $this->basename;
    }

    /**
     * Set the plugin basename.
     *
     * @param string $basename relative path from the main plugin directory
     *
     * @return $this
     */
    public function setBasename($basename)
    {
        $this->basename = $basename;

        return $this;
    }

    /**
     * Retrieve the plugin directory.
     *
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * Set the plugin's directory.
     *
     * @param string $directory absolute path to the main plugin directory
     *
     * @return $this
     */
    public function setDirectory($directory)
    {
        $this->directory = rtrim($directory, '/').'/';

        return $this;
    }

    /**
     * Retrieve the path to a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     *
     * @return string
     */
    public function getPath($path = '')
    {
        return $this->directory.ltrim($path, '/');
    }

    /**
     * Retrieve the absolute path for the main plugin file.
     *
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set the path to the main plugin file.
     *
     * @param string $file absolute path to the main plugin file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Retrieve the plugin identifier.
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set the plugin identifier.
     *
     * @param string $slug plugin identifier
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Retrieve the URL for a file in the plugin.
     *
     * @param string $path Optional. Path relative to the plugin root.
     *
     * @return string
     */
    public function getUrl($path = '')
    {
        return $this->url.ltrim($path, '/');
    }

    /**
     * Set the URL for plugin directory root.
     *
     * @param string $url URL to the root of the plugin directory
     *
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = rtrim($url, '/').'/';

        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     *
     * @return $this
     */
    public function setVersion(string $version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Register a hook provider.
     *
     * @param HookProviderInterface $provider hook provider
     *
     * @return $this
     */
    public function registerHooks(HookProviderInterface $provider)
    {
        if ($provider instanceof ContainerAwareInterface) {
            $provider->setContainer($this);
        }

        $provider->registerHooks();

        return $this;
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @param string $id
     *
     * @return bool
     */
    public function has($id)
    {
        return $this->offsetExists($id);
    }
}
