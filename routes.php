<?php

$rutas = [];

$rutas[] = [
    "Model" => "cliente",
    "Accion" => "lista",
    "Metodo" => "GET"
];

$rutas[] = [
    "Model" => "cliente",
    "Accion" => "nuevo",
    "Metodo" => "POST"
];

$rutas[] = [
    "Model" => "cliente",
    "Accion" => "actualiza",
    "Metodo" => "PUT"
];


$rutas[] = [
    "Model" => "cliente",
    "Accion" => "elimina",
    "Metodo" => "DELETE"
];


$rutas[] = [
    "Model" => "telefono",
    "Accion" => "lista",
    "Metodo" => "GET"
];

$rutas[] = [
    "Model" => "telefono",
    "Accion" => "nuevo",
    "Metodo" => "POST"
];

$rutas[] = [
    "Model" => "telefono",
    "Accion" => "actualiza",
    "Metodo" => "PUT"
];


$rutas[] = [
    "Model" => "telefono",
    "Accion" => "elimina",
    "Metodo" => "DELETE"
];

define("PROJECT_ROUTES", $rutas);