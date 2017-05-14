<?php

namespace Tonkovid\Tests\TestForOROBundle;

use Tonkovid\Tests\TestForOROBundle\Routing\Generator\Processing\HostProcessor;
use Tonkovid\Tests\TestForOROBundle\Routing\Router;
use Tonkovid\Tests\TestForOROBundle\Translation\Translator;

/**
 *  Mediator for specific communications between
 *  Router and Translator.
 */
class LocalizationManager
{
    /**
     * @var Router
     */
    private $router;
    /**
     * @var Translator
     */
    private $translator;
    /**
     * @var HostProcessor
     */
    private $hostProcessingStrategy;
    /**
     * @var boolean
     */
    private $hostProcessed = false;

    /**
     * LocalizationManager constructor.
     *
     * @param HostProcessor $strategy
     */
    public function __construct(HostProcessor $strategy)
    {
        $this->hostProcessingStrategy = $strategy;
    }

    /**
     * Checks if host has been already processed
     * and performs processing if needed.
     */
    public function checkHost()
    {
        if (!$this->hostProcessed) {
            $this->processHost();
            $this->hostProcessed = true;
        }
    }

    /**
     * Performs host processing with
     * current hostProcessingStrategy.
     */
    public function processHost()
    {
        $this
            ->setHost(
                $this
                    ->hostProcessingStrategy
                    ->process(
                        $this->getHost(),
                        ['_locale' => $this->getLocale()]
                    )
            );
    }

    /**
     * @param Router $router
     */
    public function setRouter($router)
    {
        $this->router = $router;
    }

    /**
     * @param Translator $translator
     */
    public function setTranslator($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->translator->setLocale($locale);
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->translator->getLocale();
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->router->getContext()->setHost($host);
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->router->getContext()->getHost();
    }
}
