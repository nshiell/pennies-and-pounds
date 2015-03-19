<?php

namespace Nshiell\Tests;

use Nshiell\Wallet;

class WalletTests extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider rawProvider
     */
    public function testAmountRaw($raw, $expected, $type)
    {
        $actual= (new Wallet())
            ->setAmountRaw($raw)
            ->getAmount();

        $this->assertEquals($expected, $actual, $type);
    }

    public function rawProvider()
    {
        return [
            ['4', 4, 'single digit'],
            ['85', 85, 'double digit'],
            ['197p', 197, 'pence symbol'],
            ['2p', 2, 'pence symbol single digit'],
            ['1.87', 187, 'pounds decimal'],
            ['£1.23', 123, 'pound symbol'],
            ['£2', 200, 'single digit pound symbol'],
            ['£10', 1000, 'double digit pound symbol'],
            ['£1.87p', 187, 'pound and pence symbol'],
            ['£1p', 100, 'missing pence'],
            ['£1.p', 100, 'missing pence but present decimal point'],
            ['001.41p', 141, 'buffered zeros'],
            ['4.235p', 424, 'rounding three decimal places to two'],
            ['£1.257422457p', 126, 'rounding with symbols'],

            ['', 0, 'empty string'],
            ['1x', 0, 'non-numeric character'],
            ['£1x.0p', 0, 'non-numeric character'],
            ['£p', 0, 'missing digits']
        ];
    }

    /**
     * @dataProvider coinsProvider
     */
    public function testGetCoins($raw, array $expected)
    {
        $actual= (new Wallet())
            ->setAmountRaw($raw)
            ->getCoins();

        $this->assertEquals($expected, $actual);
    }

    public function coinsProvider()
    {
        return [
            ['0', []
            ],
            ['123', [
                'X1'  => 1,
                '20p' => 1,
                '2p'  => 1,
                '1p'  => 1]
            ],
            ['1000', [
                'X2'  => 5]
            ],
            ['99', [
                '50p' => 1,
                '20p' => 2,
                '2p'  => 4,
                '1p'  => 1]
            ],
            ['58701', [
                'X2'  => 293,
                'X1'  => 1,
                '1p'  => 1]
            ],
        ];
    }
}