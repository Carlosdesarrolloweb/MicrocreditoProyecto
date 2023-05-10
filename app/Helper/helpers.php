<?php

if (!function_exists('asHtml')) {
    function asHtml($string)
    {
        return htmlspecialchars_decode($string);
    }
}
