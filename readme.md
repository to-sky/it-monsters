## Тестовое задание для компании "IT Monsters"

Установка проекта:
1. Установка соединения с базой данных. Необходимо изменить конфигурaционный файл `config.php`

2. Создание автозагрузчика
   
-   `composer dump-autoload`

3. Создание базы данных и схемы таблиц
   
-   `php create_db.php`

4. Запуск веб-сервера
   
 -  `php -S localhost:8080`


### Маршруты:

|HTTP method | URI             | Controller          | Method     |
|------------|-----------------|---------------------|------------|
|GET         | /               | ProductController   | index      |
|GET         | /upload-form    | UploadController    | uploadForm |
|POST        | /upload         | UploadController    | upload     |