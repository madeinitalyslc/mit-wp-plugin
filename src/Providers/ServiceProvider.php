<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use League\Container\Container;
use League\Container\ServiceProvider\AbstractServiceProvider;

/**
 * Class ServiceProvider
 *
 * @package MadeInItalySLC\WP\Plugin\Providers
 */
class ServiceProvider extends AbstractServiceProvider
{
    /**
     * @var array
     */
    protected $provides = [
        'plugin.filename',
        'plugin.slug',
        'plugin.basename',
        'plugin.directory',
        'plugin.url'
    ];

    /**
     * @var string
     */
    private $filename;

    /**
     * @var string
     */
    private $slug;

    /**
     * ServiceProvider constructor.
     *
     * @param string $filename
     * @param string $slug
     */
    public function __construct(string $filename, string $slug)
    {
        $this->filename = $filename;
        $this->slug = $slug;
    }

    /**
     * Register service provider
     */
    public function register()
    {
        /** @var Container $container */
        $container = $this->getContainer();

        $container->add('plugin.filename', $this->filename);
        $container->add('plugin.slug', $this->slug);

        $container->add('plugin.basename', plugin_basename($this->filename));
        $container->add('plugin.directory', plugin_dir_path($this->filename));
        $container->add('plugin.url', plugin_dir_url($this->filename));
    }
}
