<?php
require 'autoload.php';
spl_autoload_register('myAutoloader');

$videoclub = new Videoclub("Miamber's Videoclub");

$videoclub->incluirCintaVideo("Calistenias de Miamber", 7, 100);
$videoclub->incluirDvd("El exorcista", 10, ["es", "cat"], "10:9");
$videoclub->incluirJuego("League Of Legends", 0, "PC", 5, 5);
$videoclub->listarProductos();

$videoclub->incluirSocio("Miguel", 10);
$videoclub->incluirSocio("Dani");
$videoclub->incluirSocio("Merche", 4);
$videoclub->incluirSocio("Alberto", 1);


$cliente = new Cliente("Miguelll",20);
$videoclub->alquilarSocioProductos(20, [10,7]);

$videoclub->alquilarSocioProducto(1, 5);
$videoclub->alquilarSocioProducto(4, 3);
$videoclub->alquilarSocioProducto(4, 1);
$videoclub->alquilarSocioProducto(1, 2);

$videoclub -> devolverSocioProducto(1,2);
$videoclub -> devolverSocioProducto(4,5);
$videoclub -> devolverSocioProducto(5,1);


$videoclub -> devolverSocioProductos(4,[]);
$videoclub -> devolverSocioProductos(1,[]);
$videoclub -> devolverSocioProductos(1,[2]);
$videoclub -> devolverSocioProductos(1,[5]);
$videoclub -> devolverSocioProductos(4,[1,3]);


$videoclub->listarSocios();


?>