<?php

declare(strict_types=1);

namespace App\Models;

use Core\Database;

abstract class Model
{
    public function __construct(protected Database $db)
    {
    }
}