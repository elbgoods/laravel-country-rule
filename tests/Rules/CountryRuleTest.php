<?php

namespace Elbgoods\CountryRule\Tests\Rules;

use Elbgoods\CountryRule\Rules\CountryRule;
use Elbgoods\CountryRule\Tests\TestCase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use League\ISO3166\ISO3166;

final class CountryRuleTest extends TestCase
{
    /**
     * @test
     * @dataProvider provideValidCountryFormats
     */
    public function it_accepts_all_possible_country_formats(string $format): void
    {
        $rule = new CountryRule($format);

        static::assertInstanceOf(CountryRule::class, $rule);
    }

    /** @test */
    public function it_throws_exception_when_passed_invalid_format(): void
    {
        static::expectException(InvalidArgumentException::class);
        static::expectExceptionMessage('The given format "foobar" is not valid [alpha2, alpha3, name, numeric]');

        new CountryRule('foobar');
    }

    /** @test */
    public function it_is_required_by_default(): void
    {
        $rule = new CountryRule(ISO3166::KEY_ALPHA2);

        static::assertFalse($rule->isNullable());
        static::assertTrue($rule->isRequired());
    }

    /** @test */
    public function it_is_nullable(): void
    {
        $rule = new CountryRule(ISO3166::KEY_ALPHA2);
        $rule->nullable();

        static::assertTrue($rule->isNullable());
        static::assertFalse($rule->isRequired());
    }

    /**
     * @test
     * @dataProvider provideValidCountryFormats
     */
    public function validator_generates_correct_message(string $format): void
    {
        $validator = Validator::make([
            'country' => 'foobar',
        ], [
            'country' => new CountryRule($format),
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            static::assertArrayHasKey('country', $errors);
            static::assertArrayHasKey(0, $errors['country']);
            static::assertStringStartsWith('country is not a valid ', $errors['country'][0]);
        }
    }

    /**
     * @test
     * @dataProvider provideValidCountryFormats
     */
    public function validator_generates_correct_message_with_custom_translations(string $format): void
    {
        Lang::addLines([
            'validation.attributes.country' => 'Country-Code',
        ], Lang::getLocale());

        Lang::addLines([
            'validation.country.'.$format => ':attribute should be a valid Country.',
        ], Lang::getLocale(), 'countryRule');

        $validator = Validator::make([
            'country' => 'foobar',
        ], [
            'country' => new CountryRule($format),
        ]);

        try {
            $validator->validate();
        } catch (ValidationException $exception) {
            $errors = $exception->errors();
            static::assertArrayHasKey('country', $errors);
            static::assertArrayHasKey(0, $errors['country']);
            static::assertSame('Country-Code should be a valid Country.', $errors['country'][0]);
        }
    }

    public function provideValidCountryFormats(): array
    {
        return [
            [ISO3166::KEY_ALPHA2],
            [ISO3166::KEY_ALPHA3],
            [ISO3166::KEY_NUMERIC],
            [ISO3166::KEY_NAME],
        ];
    }
}
