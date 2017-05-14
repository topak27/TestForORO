<?php

namespace Tonkovid\Tests\TestForOROBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Tonkovid\Tests\TestForOROBundle\Routing\Router;
use Tonkovid\Tests\TestForOROBundle\Translation\Translator;

class CustomPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $manager = new Reference('tonkovid_tests_test_for_oro.localization_manager');

        $routerDefinition = $container->getDefinition('router.default');
        $routerDefinition->setClass(Router::class);
        $routerDefinition->addMethodCall('setManager', [$manager]);

        $translatorDefinition = $container->getDefinition('translator.default');
        $translatorDefinition->setClass(Translator::class);
    }
}
