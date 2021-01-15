<?php

function console_log($data)
{
    echo '<script>';
    echo 'console.log(' . json_encode($data) . ')';
    echo '</script>';
}

function presentPrice($price)
{
    return numfmt_format_currency(
        numfmt_create('en_US', \NumberFormatter::CURRENCY),
        $price / 100,
        "USD"
    );
}

function presentImage($path)
{
    return $path && file_exists('storage/' . $path) ? asset('storage/' . $path) : asset('img/default.jpg');
}
