<?php

use League\ISO3166\ISO3166;

return [
    'country' => [
        ISO3166::KEY_ALPHA2 => ':attribute is not a valid alpha2 Country-Code.',
        ISO3166::KEY_ALPHA3 => ':attribute is not a valid alpha3 Country-Code.',
        ISO3166::KEY_NUMERIC => ':attribute is not a valid Country-Number.',
        ISO3166::KEY_NAME => ':attribute is not a valid Country-Name.',
    ],
];
