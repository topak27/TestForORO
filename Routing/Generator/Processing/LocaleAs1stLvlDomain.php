<?php

namespace Tonkovid\Tests\TestForOROBundle\Routing\Generator\Processing;

/**
 *  Concrete host processing strategy.
 *  Replaces the first level part of domain
 *  with provided or default locale.
 */
class LocaleAs1stLvlDomain implements HostProcessor
{
    const LOCALE_KEY = '_locale';
    private $defaultLocale;

    /**
     * LocaleAs1stLvlDomain constructor.
     *
     * @param string $defaultLocale
     */
    public function __construct($defaultLocale)
    {
        $this->defaultLocale = $this->explode($defaultLocale);
    }

    /**
     * {@inheritdoc}
     */
    public function process($host, $params = [])
    {
        $resultHost = $host;
        if (isset($params[self::LOCALE_KEY])) {
            $input = $params[self::LOCALE_KEY];
            $exploded = $this->explode($input);
            if ($this->updateNeeded($input, $exploded)) {
                $resultHost = $this->updateHost($host, $exploded);
            }
        }

        return $resultHost;
    }

    /**
     * Fetches only first part ('en' for 'en_En').
     *
     * @param string $input
     * @return string mixed
     */
    private function explode($input)
    {
        return explode('_', $input)[0];
    }

    /**
     * Decision about update necessity.
     *
     * @param string $input
     * @param string $exploded
     * @return bool
     */
    private function updateNeeded($input, $exploded)
    {
        $defaultLocale = $this->defaultLocale;

        if ($defaultLocale && $exploded &&
            $input != $defaultLocale && $exploded != $defaultLocale) {
            return true;
        }

        return false;
    }

    /**
     * Update operation.
     *
     * @param string $host
     * @param string $locale
     * @return string
     */
    private function updateHost($host, $locale)
    {
        $hostParts  = explode('.', $host);
        $partsCount = count($hostParts);
        $hostParts[$partsCount-1] = $locale;

        return implode('.', $hostParts);
    }
}
