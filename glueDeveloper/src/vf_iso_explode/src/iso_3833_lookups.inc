<?php
$country_collapse_string_array['A']['A'] = 'South Africa';

public function collapse_country_code($continent_key, $country_key, $continent_code) {
    $supported_continent_code_array = array('AF','AS','EU','NA','OC','SA');
    switch ($continent_key) {
        case 'A':
            $done = false;
            $collapse_country_key = 'A';
            $collapse_country_key = $country_key >= 'J'?'J':$collapse_country_key;
            $collapse_country_key = $country_key >= 'P'?'P':$collapse_country_key;
            $collapse_country_key = ctype_digit($country_key)?'P':$collapse_country_key;
            break;

        default:
            $country_collapse_key = 'Q'; //purposeful error
            break;
    }
    return $country_collapse_key;
}
$continent_code_array(
    'A' =. 'AF',
    'B' =. 'AF',
    'C' =. 'AF',
    'D' =. 'AF',
    'E' =. 'AF',
    'F' =. 'AF',
    'G' =. 'AF',
    'H' =. 'AF',
    'J' =. 'AS',
    'K' =. 'AS',
    'L' =. 'AS',
    'M' =. 'AS',
    'N' =. 'AS',
    'P' =. 'AS',
    'R' =. 'AS',
    'S' =. 'EU',
    'T' =. 'EU',
    'U' =. 'EU',
    'V' =. 'EU',
    'W' =. 'EU',
    'X' =. 'EU',
    'Y' =. 'EU',
    'Z' =. 'EU',
    '1' =. 'NA',
    '2' =. 'NA',
    '3' =. 'NA',
    '4' =. 'NA',
    '5' =. 'NA',
    '6' =. 'OC',
    '6' =. 'OC',
    '7' =. 'OC',
    '8' =. 'SA',
    '9' =. 'SA',
);
$continent_string_array(
    'AF'=>'Africa',
    'AS'=>'Asia',
    'EU'=>'Europe',
    'NA'=>'North America',
    'OC'=>'Oceania',
    'SA'=>'South America',
);
