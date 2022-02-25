<?php

if (!function_exists('dump')) {
    function dump()
    {
        echo '<pre>';
        var_dump(func_get_args());
        echo '</pre>';
    }
}
