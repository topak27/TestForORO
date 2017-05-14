<?php

namespace Tonkovid\Tests\TestForOROBundle\Routing\Generator\Processing;

class LocaleAs1stLvlDomainTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider dataProvider
     */
    public function testProcess($defaultLocale, $params, $host, $expectedResult)
    {
        $hostProcessor = new LocaleAs1stLvlDomain($defaultLocale);
        $this->assertEquals(
            $expectedResult,
            $hostProcessor->process($host, $params)
        );
    }

    public function dataProvider()
    {
        return array_merge(
            $this->setFor('domain.com', 'domain.ru'),
            $this->setFor('my.domain.com', 'my.domain.ru')
        );
    }

    private function setFor($original, $mutated)
    {
        return [
            // No mutations. Expected result — the same.
            ['en',      ['_locale'=>'en'],      $original, $original],
            ['ru_Ru',   ['_locale'=>'ru'],      $original, $original],
            ['ru',      ['_locale'=>'ru_Ru'],   $original, $original],
            [null,      ['_locale'=>'ru_Ru'],   $original, $original],
            ['en',      ['_locale'=>null],      $original, $original],
            ['en',      ['_local'=>'ru'],       $original, $original],
            ['en',      [],                     $original, $original],
            ['en',      null,                   $original, $original],

            // Processing performed
            ['en',      ['_locale'=>'ru'],      $original, $mutated],
            ['en',      ['_locale'=>'ru_Ru'],   $original, $mutated],
            ['en_En',   ['_locale'=>'ru'],      $original, $mutated],
            ['en_En',   ['_locale'=>'ru_Ru'],   $original, $mutated]
        ];
    }
}
