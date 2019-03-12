<?php

/**
 * Hook provider interface.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright Copyright (c) 2015 Cedaro, LLC
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin;

if (\interface_exists('HookProviderInterface')) {
    return;
}

/**
 * Hook provider interface.
 *
 * @package MadeInItalySLC\WP\Plugin
 */
interface HookProviderInterface
{
    /**
     * Registers hooks for the plugin.
     */
    public function registerHooks();
}
