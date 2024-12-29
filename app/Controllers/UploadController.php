<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\CsvParser;
use Core\App;
use Exception;

class UploadController
{
    /**
     * Show file upload form
     */
    public function uploadForm()
    {
        require view('upload-form');
    }

    /**
     * Parse CSV file and store to the Database
     */
    public function upload()
    {
        if (!array_key_exists('csv_file', $_FILES) || $_FILES['csv_file']['type'] !== 'text/csv') {
            $_SESSION['error'] = 'Неверный тип файла или файл поврежден.';

            redirect('/upload-form');
        }

        try {
            $parser = new CsvParser($_FILES['csv_file']['tmp_name']);

            $product = App::resolve('Product');

            $product->importFromFile($parser->process()->getItems());
        } catch (Exception $e) {
            exit($e->getMessage());
        }

        redirect('/');
    }
}