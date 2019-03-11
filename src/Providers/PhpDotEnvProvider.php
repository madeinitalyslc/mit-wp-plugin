<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use Dotenv\Dotenv;
use MadeInItalySLC\WP\Plugin\ContainerAwareTrait;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

if (\class_exists('PhpDotEnvProvider')) return;

/**
 * Class PhpDotEnvProvider.
 */
class PhpDotEnvProvider implements ServiceProviderInterface
{
    use ContainerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function register(Container $container)
    {
        $dotenv = Dotenv::create($container['plugin.directory']);

        $dotenv->load();
    }
}
