<?php

namespace ShooglyPeg\Tests\Domain;

use PHPUnit\Framework\TestCase;
use ShooglyPeg\Domain\Currency;
use ShooglyPeg\Domain\Exceptions\InvalidCurrency;

final class CurrencyTest extends TestCase
{
    /**
     * @return void
     */
    public function testInstantiates(): void
    {
        $currency = new Currency('GBP');

        $this->assertInstanceOf(Currency::class, $currency);
        $this->assertEquals('GBP', (string) $currency);
        $this->assertEquals('£', $currency->symbol());
    }

    /**
     * @return void
     */
    public function testInvalidCurrency(): void
    {
        $this->expectException(InvalidCurrency::class);
        $this->expectExceptionMessage('jobby is not a valid currency.');

        new Currency('jobby');
    }
}
