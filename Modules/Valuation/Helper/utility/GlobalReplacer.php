<?php
if (!function_exists('__isset')) {

    function __isset($val){

        return isset($val)?$val:'';
    }
}

?>