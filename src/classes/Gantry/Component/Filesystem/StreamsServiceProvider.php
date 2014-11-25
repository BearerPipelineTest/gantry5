<?php
namespace Gantry\Component\Filesystem;

use Gantry\Component\File\CompiledYamlFile;
use Pimple\Container;
use RocketTheme\Toolbox\DI\ServiceProviderInterface;
use RocketTheme\Toolbox\ResourceLocator\ResourceLocatorInterface;
use RocketTheme\Toolbox\ResourceLocator\UniformResourceLocator;
use RocketTheme\Toolbox\StreamWrapper\ReadOnlyStream;
use RocketTheme\Toolbox\StreamWrapper\Stream;

class StreamsServiceProvider implements ServiceProviderInterface
{
    public function register(Container $gantry)
    {
        $sp = $this;

        $gantry['locator'] = function($c) use ($sp) {
            return new UniformResourceLocator(GANTRY5_ROOT);
        };
        $gantry['streams'] = function($c) use ($sp) {
            $schemes = (array) $c['platform']->get('streams');

            /** @var UniformResourceLocator $locator */
            $locator = $c['locator'];

            $streams = new Streams($locator);
            $streams->add($schemes);

            CompiledYamlFile::setCachePath($locator->findResource('cache://') . '/compiled/yaml');

            return $streams;
        };
    }
}
