<?php

namespace Tonkovid\Tests\TestForOROBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tonkovid\Tests\TestForOROBundle\DependencyInjection\Compiler\CustomPass;

class TonkovidTestsTestForOROBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new CustomPass());
    }
}
