<?php

/**
 * Var Dump Server Provider.
 *
 * @author Pereira Pulido Nuno Ricardo <r.pereira@madeinitalyslc.it>
 * @copyright 2019 Made In Italy SLC
 */

namespace MadeInItalySLC\WP\Plugin\Provider;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

if (\class_exists('VarDumperServerProvider')) {
    return;
}

/**
 * Class VarDumpServerProvider.
 */
class VarDumpServerProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     */
    public function register(Container $container)
    {
        $cloner = new \Symfony\Component\VarDumper\Cloner\VarCloner();
        $fallbackDumper = \in_array(\PHP_SAPI, array('cli', 'phpdbg')) ? new \Symfony\Component\VarDumper\Dumper\CliDumper() : new \Symfony\Component\VarDumper\Dumper\HtmlDumper();

        $dumper = new \Symfony\Component\VarDumper\Dumper\ServerDumper(env('VAR_DUMP_SERVER_HOST', 'tcp://127.0.0.1:9912'), $fallbackDumper, [
            'cli' => new \Symfony\Component\VarDumper\Dumper\ContextProvider\CliContextProvider(),
            'source' => new \Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider(),
        ]);

        \Symfony\Component\VarDumper\VarDumper::setHandler(function ($var) use ($cloner, $dumper) {
            $dumper->dump($cloner->cloneVar($var));
        });
    }
}
