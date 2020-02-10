<?php

namespace Elbgoods\CountryRule\Tests\Rules;

use Elbgoods\CountryRule\Rules\CountryNameRule;
use Elbgoods\CountryRule\Tests\TestCase;

final class CountryNameRuleTest extends TestCase
{
    /** @test */
    public function it_passes_specific_valid_name_values(): void
    {
        $rule = new CountryNameRule();

        static::assertTrue($rule->passes('country', 'Germany'));
        static::assertTrue($rule->passes('country', 'United Kingdom of Great Britain and Northern Ireland'));
        static::assertTrue($rule->passes('country', 'United States of America'));
    }

    /**
     * @test
     * @dataProvider provideCountryName
     */
    public function it_passes_valid_name_values(string $value): void
    {
        $rule = new CountryNameRule();

        static::assertTrue($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha2
     */
    public function it_fails_when_passed_alpha2_values(string $value): void
    {
        $rule = new CountryNameRule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryAlpha3
     */
    public function it_fails_when_passed_alpha3_values(string $value): void
    {
        $rule = new CountryNameRule();

        static::assertFalse($rule->passes('country', $value));
    }

    /**
     * @test
     * @dataProvider provideCountryNumeric
     */
    public function it_fails_when_passed_numeric_values(string $value): void
    {
        $rule = new CountryNameRule();

        static::assertFalse($rule->passes('country', $value));
    }
}
