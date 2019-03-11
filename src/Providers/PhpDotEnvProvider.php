<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use Dotenv\Dotenv;
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
    /**
     * @param Container $pimple
     */
    public function register(Container $pimple)
    {
        $pimple['services.php_dot_env'] = function (Container $c) {
            $dotenv = Dotenv::create($c['plugin.directory']);

            $dotenv->load();

            return $dotenv;
        };
    }
}
