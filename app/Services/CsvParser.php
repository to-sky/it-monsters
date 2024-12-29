<?php

declare(strict_types=1);

namespace App\Services;

use Exception;

class CsvParser
{
    /**
     * All items from CSV file
     * @var array
     */
    protected array $items = [];

    /**
     * File pointer
     * @var false|resource
     */
    private $fp;

    /**
     * Headers from CSV file
     * @var array
     */
    private array $headers = [];

    /**
     * CsvParser constructor.
     * @param string $fileName
     * @param string $separator
     * @param int|null $length
     * @throws Exception
     */
    function __construct(string $fileName, private string $separator = ";", private $length = null)
    {
        if (!file_exists($fileName)) {
            throw new Exception("File '$fileName' doesn't exists");
        }

        $this->fp = fopen($fileName, 'r');
    }

    /**
     * Main handler
     * @return $this
     * @throws Exception
     */
    public function process(): static
    {
        if ($this->fp === false) {
            throw new Exception("Can't open file");
        }

        while (($row = fgetcsv($this->fp, $this->length, $this->separator, PHP_EOL)) !== false) {
            $row = $this->prepareRowData($row);

            if ($this->setHeaders($row)) {
                continue;
            }

            $this->items[] = $this->fixDescription($row);
        }

        fclose($this->fp);

        return $this;
    }

    /**
     * Set headers
     * @param $headers
     * @return mixed
     */
    private function setHeaders($headers): mixed
    {
        return (bool) empty($this->headers)
            ? $this->headers = $headers
            : false;
    }

    /**
     * Prepare data for the row
     * @param $row
     * @return array
     */
    private function prepareRowData($row): array
    {
        $item = [];

        foreach ($row as $rowItem) {
            if ($this->headers) {
                $rowItem = replaceBackslashesWithQuotes($rowItem);
            }

            $item[] = preg_replace('/,{2,}|"|/', '', $rowItem);
        }

        return $item;
    }

    /**
     * Fix the text of the description column which contains a semicolon
     * @param array $row
     * @return array
     */
    private function fixDescription(array $row): array
    {
        $limit = count($this->headers);

        if (count($row) <= $limit) {
            return $row;
        }

        $splitIndex = $limit - 1;

        $head = array_slice($row, 0, $splitIndex);
        $tail = array_slice($row, $splitIndex);

        $mergedTail = implode('; ', $tail);

        $head[] = $mergedTail;

        return $head;
    }

    /**
     * Get all parsed items
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * Get headers from CSV file
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }
}