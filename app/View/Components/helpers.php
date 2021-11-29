<?php

if(!function_exists('slug_formater')) {
    function slug_formater($slug) {
        $preg = preg_replace("/[^A-Za-z0-9 ]/", '', $slug);
        $replace = str_replace(" ", "-", $preg);
        return strtolower($replace);
    }
}
