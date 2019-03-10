<?php

namespace MadeInItalySLC\WP\Plugin\Providers;

use MadeInItalySLC\WP\Plugin\Hooks\I18n;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['hooks.i18n'] = function (Container $container) {
            return new I18n();
        };
    }
}
