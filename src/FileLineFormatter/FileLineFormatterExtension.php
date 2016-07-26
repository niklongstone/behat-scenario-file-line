<?php
/**
 * This file is part of the FileLineFormatter library.
 *
 * (c) Nicola Pietroluongo <nik.longstone@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FileLineFormatter;

use Behat\Testwork\ServiceContainer\Extension as ExtensionInterface;
use Behat\Testwork\ServiceContainer\ExtensionManager;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

/**
 * Class FileLineFormatterExtension
 *
 * @package FileLineFormatter
 */
class FileLineFormatterExtension implements ExtensionInterface {

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container) {
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigKey() {
        return "linefile";
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(ExtensionManager $extensionManager) {
    }

    /**
     * {@inheritdoc}
     */
    public function configure(ArrayNodeDefinition $builder) {
        $builder->children()->scalarNode("name")->defaultValue("emusehtml");
        $builder->children()->scalarNode("base_path")->defaultValue("Twig");
    }

    /**
     * {@inheritdoc}
     */
    public function load(ContainerBuilder $container, array $config) {
        $definition = new Definition("FileLineFormatter\\FileLineFormatter");
        $definition->addArgument($config['name']);
        $definition->addArgument('%paths.base%');

        $container->setDefinition("console.formatter", $definition)
            ->addTag("output.formatter");
    }
}