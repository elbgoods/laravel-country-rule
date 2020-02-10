<?php

namespace Elbgoods\CountryRule\Rules;

use League\ISO3166\ISO3166;

class CountryNameRule extends CountryRule
{
    public function __construct(bool $required = true)
    {
        parent::__construct(ISO3166::KEY_NAME, $required);
    }
}