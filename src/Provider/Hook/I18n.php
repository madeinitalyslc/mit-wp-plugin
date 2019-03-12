<?php

/**
 * I18n Hook Provider.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin\Provider\Hook;

use MadeInItalySLC\WP\Plugin\AbstractHookProvider;
use MadeInItalySLC\WP\Plugin\ContainerAwareInterface;
use MadeInItalySLC\WP\Plugin\ContainerAwareTrait;

if (\class_exists('I18n')) {
    return;
}

/**
 * Class I18n.
 *
 * @package MadeInItalySLC\WP\Plugin\Provider\Hook
 */
class I18n extends AbstractHookProvider implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * Register hooks.
     *
     * Loads the text domain during the `plugins_loaded` action.
     */
    public function registerHooks()
    {
        if (did_action('plugins_loaded')) {
            $this->loadTextDomain();
        } else {
            $this->addAction('plugins_loaded', 'loadTextDomain');
        }
    }

    /**
     * Load the text domain to localize the plugin.
     */
    protected function loadTextDomain()
    {
        $plugin_rel_path = dirname($this->getContainer()->get('plugin.basename')) . '/languages';

        load_plugin_textdomain($this->getContainer()->get('plugin.slug'), false, $plugin_rel_path);
    }
}
