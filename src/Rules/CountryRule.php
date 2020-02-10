<?php

namespace Elbgoods\CountryRule\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Lang;
use InvalidArgumentException;
use League\ISO3166\ISO3166;

class CountryRule implements Rule
{
    protected const FORMATS = [
        ISO3166::KEY_ALPHA2,
        ISO3166::KEY_ALPHA3,
        ISO3166::KEY_NAME,
        ISO3166::KEY_NUMERIC,
    ];

    protected bool $required;
    protected string $format;

    public function __construct(string $format, bool $required = true)
    {
        if(! in_array($format, self::FORMATS)) {
            throw new InvalidArgumentException(sprintf('The given format "%s" is not valid [%s]', $format, implode(', ', self::FORMATS)));
        }

        $this->format = $format;
        $this->required = $required;
    }

    public function nullable(): self
    {
        $this->required = false;

        return $this;
    }

    public function passes($attribute, $value): bool
    {
        if ($value === null && $this->isNullable()) {
            return true;
        }

        $countries = Arr::pluck($this->getISO3166()->all(), $this->format);

        return in_array($value, $countries, true);
    }

    public function message(): string
    {
        return Lang::get('countryRule::validation.country.'.$this->format);
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function isNullable(): bool
    {
        return ! $this->required;
    }

    protected function getISO3166(): ISO3166
    {
        return app(ISO3166::class);
    }
}