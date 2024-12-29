<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database;
use Exception;

class Product extends Model
{
    public string $table = 'products';

    /**
     * @var array|string[]
     */
    public array $columns = [
        'code', 'name', 'level_1', 'level_2', 'level_3', 'price', 'price_sp', 'quantity', 'properties',
        'joint_purchases', 'units', 'image', 'show_on_homepage', 'description'
    ];

    /**
     * Get all products
     * @return mixed
     */
    public function all(): mixed
    {
        return $this->db->query("SELECT * FROM $this->table")->all();
    }

    /**
     * Get by code
     * @param $code
     * @return mixed
     */
    public function getByCode($code): mixed
    {
        return $this->db->query("SELECT * from $this->table WHERE code = :code", ['code' => $code])->get();
    }

    /**
     * Create entity
     * @param $data
     * @return Database
     */
    public function create($data): Database
    {
        $columns = implode(', ', $this->columns);
        $prepare = implode(', ', array_map(fn ($column) => ":{$column}", $this->columns));

        return $this->db->query("INSERT INTO $this->table($columns) VALUES($prepare)", $data);
    }

    /**
     * Insert data from CSV file
     * @param $items
     * @return bool
     */
    public function importFromFile($items): bool
    {
        foreach ($items as $item) {
            if (count($this->columns) !== count($item)) {
                throw new Exception('Incorrect column size in file.');
            }

            $item = array_combine($this->columns, $item);

            $item['price'] = floatval($item['price']);
            $item['price_sp'] = floatval($item['price_sp']);

            if (!$this->getByCode($item['code'])) {
                $this->create($item);
            }
        }

        return true;
    }
}