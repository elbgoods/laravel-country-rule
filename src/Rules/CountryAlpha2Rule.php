<?php

namespace Elbgoods\CountryRule\Rules;

use League\ISO3166\ISO3166;

class CountryAlpha2Rule extends CountryRule
{
    public function __construct(bool $required = true)
    {
        parent::__construct(ISO3166::KEY_ALPHA2, $required);
    }
}