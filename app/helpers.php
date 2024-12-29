<?php

/**
 * Replace backslashes with quotes
 * @param $input
 * @return array|string|null
 */
function replaceBackslashesWithQuotes($input): array|string|null
{
    // Change first backslash to «
    $input = preg_replace('/\\\\/', '«', $input, 1);

    // Change last backslash to »
    $input = preg_replace('/\\\\/', '»', $input, 1);

    return $input;
}

/**
 * Die and dump
 * @param $value
 */
function dd($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';

    die();
}

/**
 * Redirect to path
 * @param $path
 */
function redirect($path)
{
    header("location: {$path}");
    exit();
}

/**
 * Get full path to view
 * @param $path
 * @return string
 */
function view($path): string
{
    return BASE_PATH . "/views/{$path}.php";
}