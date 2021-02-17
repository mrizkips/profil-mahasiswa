<?php

if (!function_exists('date_format_id')) {
    function date_format_id($date)
    {
        $months = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );

        $ex = explode('-', $date);
        return "$ex[2] " . $months[(int)$ex[1]] . " $ex[0]";
    }
}

if (!function_exists('is_array_empty')) {
    function is_array_empty($arr)
    {
        if(is_array($arr)) {
            foreach($arr as $key => $value){
                if(!empty($value) || $value != NULL || $value != ""){
                    return true;
                    break;
                }
            }
            return false;
        }
    }
}
