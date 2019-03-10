<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use Dotenv\Dotenv;
use MadeInItalySLC\WP\Plugin\Plugin;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

if (\class_exists('PhpDotEnvProvider')) return;

/**
 * Class PhpDotEnvProvider
 *
 * @package MadeInItalySLC\WP\Plugin\Providers
 */
class PhpDotEnvProvider implements ServiceProviderInterface
{
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['services.php_dot_env'] = function (Container $container) {
            /** @var Plugin $plugin */
            $plugin = $container['plugin'];
            
            $dotenv = Dotenv::create($plugin->getDirectory());
            
            $dotenv->load();
            
            return $dotenv;
        };
    }
}
