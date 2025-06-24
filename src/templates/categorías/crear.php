<?php
require_once __DIR__ . '/../../models/Categoria.php';
$categoriaModel = new Categoria();
$categorias = $categoriaModel->obtenerTodas();
