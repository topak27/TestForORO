<?php

namespace Tonkovid\Tests\TestForOROBundle\Routing\Generator\Processing;

/**
 * Host processing strategy
 */
interface HostProcessor
{
    /**
     * Performs processing
     *
     * @param string $host
     * @param array $params
     * @return string
     */
    public function process($host, $params = []);
}
