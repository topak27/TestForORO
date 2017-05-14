<?php

namespace Tonkovid\Tests\TestForOROBundle\Translation;

use Symfony\Bundle\FrameworkBundle\Translation\Translator as BaseTranslator;

class Translator extends BaseTranslator
{
    /**
     * {@inheritdoc}
     */
    public function trans($id, array $parameters = array(), $domain = null, $locale = null)
    {
        if (null === $domain || 'messages' === $domain) {
            $domain = 'example';
        }

        return parent::trans($id, $parameters, $domain, $locale);
    }

    /**
     * {@inheritdoc}
     */
    public function transChoice($id, $number, array $parameters = array(), $domain = null, $locale = null)
    {
        if (null === $domain || 'messages' === $domain) {
            $domain = 'example';
        }

        return parent::transChoice($id, $number, $parameters, $domain, $locale);
    }
}
