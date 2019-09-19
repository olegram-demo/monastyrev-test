<?php

/**
 * @param string $filename
 * @param string $delimiter
 * @param bool $removeHeader
 * @return array
 */
function parse_csv(string $filename, string $delimiter = ';', bool $removeHeader = true): array
{
    $parsedData = array_map(function (string $data) use ($delimiter) {
        return str_getcsv($data, $delimiter);
    }, file($filename));

    if ($removeHeader) {
        array_shift($parsedData);
    }

    return $parsedData;
}
