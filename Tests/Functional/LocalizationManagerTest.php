<?php

namespace Tonkovid\Tests\TestForOROBundle;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class LocalizationManagerTest extends KernelTestCase
{
    private $router;
    private $translator;
    private $manager;

    protected function setUp()
    {
        static::bootKernel();
        $container = static::$kernel->getContainer();
        $this->router     = $container->get('router');
        $this->translator = $container->get('translator');
        $this->manager    = $container->get('tonkovid_tests_test_for_oro.localization_manager');
    }

    public function testTranslatorWithDefaultLocale()
    {
        $this->assertEquals(
            'hello',
            $this->translator->trans('greeting')
        );
    }

    public function testTranslatorWithProvidedLocale()
    {
        $this->manager->setLocale('ru');
        $this->assertEquals(
            'привет',
            $this->translator->trans('greeting')
        );
    }

    public function testRouterWithDefaultLocale()
    {
        $this->assertEquals(
            'http://example.com/',
            $this->router->generate('home', [], true)
        );
    }

    public function testRouterWithProvidedLocale()
    {
        $this->manager->setLocale('ru');
        $this->assertEquals(
            'http://example.ru/',
            $this->router->generate('home', [], true)
        );
    }
}
