<?php

namespace Elbgoods\CountryRule\Tests\Rules;

use Elbgoods\CountryRule\Rules\CountryAlpha3Rule;
use Elbgoods\CountryRule\Tests\TestCase;

final class CountryAlpha3RuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_alpha3_values(): void
    {
        $rule = new CountryAlpha3Rule();

        static::assertTrue($rule->passes('country', 'DEU'));
        static::assertTrue($rule->passes('country', 'GBR'));
        static::assertTrue($rule->passes('country', 'USA'));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha3
     */
    public function it_passes_valid_alpha3_values(string $value): void
    {
        $rule = new CountryAlpha3Rule();

        static::assertTrue($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha2
     */
    public function it_fails_when_passed_alpha2_values(string $value): void
    {
        $rule = new CountryAlpha3Rule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryNumeric
     */
    public function it_fails_when_passed_numeric_values(string $value): void
    {
        $rule = new CountryAlpha3Rule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryName
     */
    public function it_fails_when_passed_name_values(string $value): void
    {
        $rule = new CountryAlpha3Rule();

        static::assertFalse($rule->passes('country', $value));
    }
}
