<?php

$config = require_once __DIR__ . '/config.php';

$host = $config['database']['host'];
$port = $config['database']['port'];
$username = $config['database']['username'];
$password = $config['database']['password'];
$database = $config['database']['dbname'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;");
    echo "Database `$database` created successfully.\n";

    $pdo->exec("USE `$database`");

    $sql = "
        CREATE TABLE IF NOT EXISTS `products`( 
            `id` BigInt( 0 ) UNSIGNED AUTO_INCREMENT NOT NULL,
            `code` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `name` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `level_1` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `level_2` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `level_3` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `price` Decimal( 8, 2 ) NULL DEFAULT NULL,
            `price_sp` Decimal( 8, 2 ) NULL DEFAULT NULL,
            `quantity` Double( 22, 0 ) NOT NULL,
            `properties` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `joint_purchases` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `units` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `image` VarChar( 255 ) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
            `show_on_homepage` TinyInt( 1 ) NOT NULL,
            `description` Text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
            `created_at` Timestamp NULL DEFAULT NULL,
            `updated_at` Timestamp NULL DEFAULT NULL,
            PRIMARY KEY ( `id` ),
            CONSTRAINT `products_code_unique` UNIQUE( `code` ) )
        CHARACTER SET = utf8mb4
        COLLATE = utf8mb4_unicode_ci
        ENGINE = InnoDB;
    ";

    $pdo->exec($sql);
    echo "Tables created successfully.\n";

} catch (PDOException $e) {
    die("Error: " . $e->getMessage() . "\n");
}
