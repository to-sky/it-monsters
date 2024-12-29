<?php

$router->get("/", "ProductController@index");
$router->get("/upload-form", "UploadController@uploadForm");
$router->post("/upload", "UploadController@upload");