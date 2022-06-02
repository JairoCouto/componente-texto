<?php

if(function_exists('func_remove_mask_number') === false) {
    function func_remove_mask_number($number)
    {
        $number = preg_replace('/[^0-9]/', '', $number);

        return $number;
    }
}

