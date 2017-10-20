<?php

defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('asset_url()')) {

    function assets_url() {
        return base_url() . 'assets/';
    }

}

if (!function_exists('vendor_url()')) {

    function vendor_url() {
        return base_url() . 'vendor/';
    }

}

if (!function_exists('bower_url()')) {

    function bower_url() {
        return base_url() . 'bower_components/';
    }

}