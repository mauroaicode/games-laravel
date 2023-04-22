<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Acerca del Proyecto
Proyecto para un CRUD (Create, Read, Update, Delete) para juegos. Utilizo el patrón de diseño Repository que se utiliza para separar la lógica del modelo de la capa de persistencia de datos, lo que permite una mayor flexibilidad y escalabilidad.

El sistema permite realizar operaciones básicas de CRUD en los juegos, tales como crear, leer, actualizar y eliminar juegos. Además, he implementado una paginación de resultados para una mejor experiencia de usuario.

He utilizado buenas prácticas de programación para garantizar la calidad del código, como la inyección de dependencias, la validación de datos y la implementación de transacciones de base de datos para asegurar la integridad de los datos. En resumen, el proyecto es una aplicación básica de CRUD para juegos, desarrollada con buenas prácticas y patrones de diseño, implementada en Laravel.

Que estoy usando:

- [Migraciones](https://laravel.com/docs/10.x/migrations) y [Seeders](https://laravel.com/docs/10.x/seeding#main-content):
Estoy creando tres juegos de prueba para poblar la base de datos y mostrar.
- [Factories](https://laravel.com/docs/10.x/eloquent-factories#main-content):
Lo uso para agregar datos de prueba, en este caso estoy agregando una descripción a los tres juegos mencionados anteriormente.
- [Recursos](https://laravel.com/docs/10.x/eloquent-resources):
Son una forma de estructurar y transformar los datos que se devuelven en las respuestas de las API. En lugar de devolver los datos en su formato original, se pueden transformar en un formato estandarizado y estructurado, lo que hace que la respuesta sea más fácil de leer y entender para las aplicaciones y usuarios que consumen la API. En este caso estoy formateando la fecha con Carbon.
- [Eloquent](https://laravel.com/docs/10.x/eloquent-collections):
Lo utilizo para crear, actualizar, eliminar, listar, buscar y otros usos más.
- [Storage](https://laravel.com/docs/10.x/filesystem#main-content):
El storage lo uso para agregar una image como archivo.
- [Form Request](https://laravel.com/docs/10.x/validation#quick-writing-the-validation-logic):
Creo una validación de los datos como nombre, descripción, path imagen, url del juego.
- [Paginación](https://laravel.com/docs/10.x/pagination#main-content):
Listo todos los juegos con paginación.
- [Transacciones](https://laravel.com/docs/10.x/database#manually-using-transactions).
Lo utilizo para iniciar una transacción en la base de datos. Si alguna de las operaciones falla, se pueden utilizar las funciones DB::rollBack() y DB::commit() para revertir o confirmar la transacción, respectivamente.
- [Logs](https://laravel.com/docs/10.x/logging):
Lo utilizo para registrar un mensaje de error en el registro de la aplicación. 
- Versionamiento de la Api: En la carpeta routes de laravel, añadi una carpeta "V1", para versionar la API; ademas de agregar el controlador principal GameController dentro de la carpeta Controller/Api/V1
