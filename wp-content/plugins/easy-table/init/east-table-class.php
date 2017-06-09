<?php
class EasyTable
{
    const VERSION = "1.0";
    const SLUG = EASY_TABLE_SLUG;
    const BASE_PATH = EASY_TABLE_BASE_PATH;
    
    const BASE_URL = EASY_TABLE_URL;
    const PUBLIC_URL = self::BASE_URL . "/public";
    const CSS_URL = self::BASE_URL . "/public/css";
    const JS_URL = self::BASE_URL . "/public/js";
}


function public_url()
{
    return EasyTable::PUBLIC_URL;
}

function css_url()
{
    return EasyTable::CSS_URL;
}

function js_url()
{
    return EasyTable::JS_URL;
}