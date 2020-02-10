<?php

namespace Elbgoods\CountryRule\Tests;

use Elbgoods\CountryRule\CountryRuleServiceProvider;
use Illuminate\Support\Arr;
use League\ISO3166\ISO3166;
use Orchestra\Testbench\TestCase as Orchestra;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            CountryRuleServiceProvider::class,
        ];
    }

    public function provideCountryAlpha2(): array
    {
        return array_map(static function (string $alpha2): array {
            return [$alpha2];
        }, Arr::pluck((new ISO3166())->all(), ISO3166::KEY_ALPHA2));
    }

    public function provideCountryAlpha3(): array
    {
        return array_map(static function (string $alpha3): array {
            return [$alpha3];
        }, Arr::pluck((new ISO3166())->all(), ISO3166::KEY_ALPHA3));
    }

    public function provideCountryNumeric(): array
    {
        return array_map(static function (string $numeric): array {
            return [$numeric];
        }, Arr::pluck((new ISO3166())->all(), ISO3166::KEY_NUMERIC));
    }

    public function provideCountryName(): array
    {
        return array_map(static function (string $name): array {
            return [$name];
        }, Arr::pluck((new ISO3166())->all(), ISO3166::KEY_NAME));
    }
}
