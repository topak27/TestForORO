<?php

namespace Tonkovid\Tests\TestForOROBundle\Routing;

use Symfony\Bundle\FrameworkBundle\Routing\Router as BaseRouter;
use Tonkovid\Tests\TestForOROBundle\LocalizationManager;

class Router extends BaseRouter
{
    /**
     * @var LocalizationManager
     */
    private $manager;

    /**
     * @param LocalizationManager $manager
     */
    public function setManager($manager)
    {
        $this->manager = $manager;
    }

    /**
     * {@inheritdoc}
     */
    public function generate($name, $parameters = array(), $referenceType = self::ABSOLUTE_PATH)
    {
        $this->manager->checkHost();

        return parent::generate($name, $parameters, $referenceType);
    }
}
