<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Proyecto de Laravel

Mi primer proyecto de Laravel donde se puede insertar y mostrar diferentes articulos. Puedes registrarte y loguearte para poder insertar articulos. Si quieres ya un usuario creado puedes usar el siguiente:

Usuario: a.morcillo@sapalomera.cat
Contraseña: P@ssw0rd

## Cosas en tener en cuenta

El perfil puede que no se vea de primera mano pero esta arriba a la derecha como puedes ver en la imagen marcado en amarillo:

![Imagen donde se ve el botón del perfil](image-1.png)

La paginación le pasa lo mismo que en el perfil, que se ve poco:
![Marcada donde esta la paginación](image-2.png)

## Base de datos
Ya esta la estructura creada en los archivos de migración. Hay datos ya creados usando el seeder. Para poder crear la base de datos y los datos necesitas ejecutar los siguientes comandos:

```bash 
php artisan migrate
php artisan db:seed
```


## Requesitos

Para que este proyecto funcione correctamente, necesitarás tener instalado:

- Laravel
- Vite para el desarrollo y la construcción de la aplicación.
- Dependencias de desarrollo como @tailwindcss/forms, alpinejs, autoprefixer, axios,  laravel-vite-plugin, postcss, tailwindcss, y vite.
- Dependencias como bootstrap.
  
## Versiones

Vite: ^5.0.0
@tailwindcss/forms: ^0.5.2
alpinejs: ^3.4.2
autoprefixer: ^10.4.2
axios: ^1.6.4
laravel-vite-plugin: ^1.0.0
postcss: ^8.4.31
tailwindcss: ^3.1.0
bootstrap: ^5.3.3


