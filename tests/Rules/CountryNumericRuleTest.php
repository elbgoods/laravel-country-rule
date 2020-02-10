<?php

namespace Elbgoods\CountryRule\Tests\Rules;

use Elbgoods\CountryRule\Rules\CountryNumericRule;
use Elbgoods\CountryRule\Tests\TestCase;

final class CountryNumericRuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_numeric_values(): void
    {
        $rule = new CountryNumericRule();

        static::assertTrue($rule->passes('country', '096'));
        static::assertTrue($rule->passes('country', '276'));
        static::assertTrue($rule->passes('country', '826'));
        static::assertTrue($rule->passes('country', '840'));
    }

    /**
     * @test
     * @dataProvider provideCountryNumeric
     */
    public function it_passes_valid_numeric_values(string $value): void
    {
        $rule = new CountryNumericRule();

        static::assertTrue($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha2
     */
    public function it_fails_when_passed_alpha2_values(string $value): void
    {
        $rule = new CountryNumericRule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha3
     */
    public function it_fails_when_passed_alpha3_values(string $value): void
    {
        $rule = new CountryNumericRule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryName
     */
    public function it_fails_when_passed_name_values(string $value): void
    {
        $rule = new CountryNumericRule();

        static::assertFalse($rule->passes('country', $value));
    }
}
