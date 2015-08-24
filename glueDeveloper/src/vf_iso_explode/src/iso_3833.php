<?php

class vin
{
    public $vin;

    public $is_valid = false;

    public $iso = 3833;
    public $wmi;
    public $vds;
    public $vis;
    public $eu_characteristics;
    public $eu_identification;
    public $wmi_continent_code;
    public $wmi_continent_string;
    public $wmi_country_code;
    public $wmi_country_string;
    public $wmi_cat_div_code;
    public $wmi_cat_div_string;
    public $wmi_peryear__gt_d;
    public $v_attributes;
    public $chkd;
    public $year;
    public $plant_code;
    public $serial_id;

    public $error_code = 0; // maybe throw an error object later
    public $error_string = 'No Error';

    public $continent;
    public $country;
    // SEE 'set_() functions for attribute descriptors'

public function __construct($vin_input)
{
    $this->vin = $vin_input;
    $this->pre_validate();
    if ($this->is_valid !== true) {
        return;
    }
    $this->set_attributes();
}

public function pre_validate()
{
    $is_valid = true; // proof by contradiction
    $is_valid = strlen(trim($this->vin)) == 17?$is_valid:false;
    if ($is_valid !== true) {
        $this->error_code = 99999.1;// see set_error_string()
        $this->set_error_string($this->error_code);
        $this->is_valid = $is_valid;
        return;
    }
    $this->vin = strtoupper(trim($this->vin));
    for ($i=0; $i < 17; $i++) {
        $is_valid = ctype_alnum($this->vin[$i])?$is_valid:false;
        $is_valid = $this->vin[$i] == 'I'?false:$is_valid;
        $is_valid = $this->vin[$i] == 'O'?false:$is_valid;
        $is_valid = $this->vin[$i] == 'Q'?false:$is_valid;
    }
    if ($is_valid !== true) {
        $this->error_code = 99999.2;// see set_error_string()
        $this->set_error_string($this->error_code);
        $this->is_valid = $is_valid;
        return;
    }
    $this->is_valid = $is_valid;
}

/**
 @TODO gather this dynamically
 */
public function set_attributes()
{
    $this->set_wmi_attributes();
}
public function set_wmi_attributes()
{
    require_once 'iso_3833_lookups.inc';


    $wmi = $this->vin;
    $wmi = substr($wmi, 0, 3);
    $cat_div_key = substr($wmi, -1);
    $wmi_cat_div_code = "code pending [{$cat_div_key}]";
    $wmi_cat_div_string = "string pending [{$cat_div_key}]";
    $wmi_peryear__gt_d = $cat_div_key == '9'?false:true;
    $continent_key = $wmi[0];
    $wmi_continent_code = $continent_code_array[$continent_key];
    $wmi_continent_string = $continent_string_array[$wmi_continent_code];
    $country_key = substr($wmi, 1, 1);
    $collapse_country_key = collapse_country_code($continent_key, $country_key);
    $wmi_country_code = "[{$continent_key}][{$collapse_country_key}-{$country_key}]";
    $wmi_country_string = $country_collapse_string_array[$continent_key][$collapse_country_key];

    $this->wmi_continent_code = $wmi_continent_code;
    $this->wmi_continent_string = $wmi_continent_string;
    $this->wmi_country_code = $wmi_country_code;
    $this->wmi_country_string = $wmi_country_string;
    $this->wmi_cat_div_code = $wmi_cat_div_code;
    $this->wmi_cat_div_string = $wmi_cat_div_string;
    $this->wmi_peryear__gt_d = $wmi_peryear__gt_d;

}


public function set_error_string($error_code)
{
    $buffer = '';
    $buffer .= "Error Code [{$error_code}] is currently undefined";
    $this->error_string = $buffer;
    // return $buffer;
}

}
