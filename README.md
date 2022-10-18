<h1 align="center">SIMANTAN APIs</h1>
<h3 align="center">Sistem Dokumentasi Kegiatan</h3>

Command untuk publish vendor ke config

```bash
php artisan vendor:publish --provider="LaravelEasyRepository\LaravelEasyRepositoryServiceProvider" --tag="easy-repository-config"
```

Buka file `easy-repository.php` di folder config.
copy code di bawah dan paste di dalam file `easy-repository.php`

```bash
<?php

return [
    /**
     * The directory for all the repositories
     */
    "repository_directory" => "app/Http/Repositories",

    /**
     * Default repository namespace
     */
    "repository_namespace" => "App\Http\Repositories",

    /**
     * The directory for all the services
     */
    "service_directory" => "app/Http/Services",

    /**
     * Default service namespace
     */
    "service_namespace" => "App\Http\Services",
];

```

Command untuk buat repository sekaligus service

```bash
php artisan make:repository User --service
```
