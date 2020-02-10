<?php

namespace Elbgoods\CountryRule\Tests\Rules;

use Elbgoods\CountryRule\Rules\CountryAlpha2Rule;
use Elbgoods\CountryRule\Tests\TestCase;

final class CountryAlpha2RuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_alpha2_values(): void
    {
        $rule = new CountryAlpha2Rule();

        static::assertTrue($rule->passes('country', 'DE'));
        static::assertTrue($rule->passes('country', 'GB'));
        static::assertTrue($rule->passes('country', 'US'));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha2
     */
    public function it_passes_valid_alpha2_values(string $value): void
    {
        $rule = new CountryAlpha2Rule();

        static::assertTrue($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha3
     */
    public function it_fails_when_passed_alpha3_values(string $value): void
    {
        $rule = new CountryAlpha2Rule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryNumeric
     */
    public function it_fails_when_passed_numeric_values(string $value): void
    {
        $rule = new CountryAlpha2Rule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryName
     */
    public function it_fails_when_passed_name_values(string $value): void
    {
        $rule = new CountryAlpha2Rule();

        static::assertFalse($rule->passes('country', $value));
    }
}
