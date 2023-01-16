___
# Practica 1 Laravel

## Crear el proyecto
___

```
composer create-project laravel/laravel "Practica Laravel 1"
```

## Activa el servicio Laravel

```
php artisan serve
```

## Generar key
```
php artisan key:generate
```
## Crear la tabla Student

```
php artisan make:migration create_students_table
```

## Crear el Controller de Student

```
php artisan make:controller StudentController
```
## Guardar la migracion
```
php artisan migrate 
```
## Deshacer una migracion
```
php migration rollback
```

## Crear seeder de Student
```
php artisan make:seeder StudentSeeder
```

## Llamar al seed previamente creado
```
php artisan db:seed --class=StudentSeeder
```

## Creamos el modelo Student
```
php artisan make:model Student
```

## Crear un middleware
``` 
php artisan make:middleware CheckId
```