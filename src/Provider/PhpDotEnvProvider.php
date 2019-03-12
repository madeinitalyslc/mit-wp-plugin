<?php

/**
 * PHP Dot Env Provider.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin\Provider;

use Dotenv\Dotenv;
use MadeInItalySLC\WP\Plugin\ContainerAwareTrait;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

if (\class_exists('PhpDotEnvProvider')) {
    return;
}

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
