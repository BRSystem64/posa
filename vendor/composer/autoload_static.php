<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitfa0fd671a30fa01466b5e2c3d07c5179
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Posa\\Interfaces\\' => 16,
            'Posa\\' => 5,
        ),
        'A' => 
        array (
            'App\\Models\\' => 11,
            'App\\Controllers\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Posa\\Interfaces\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Posa/interfaces',
        ),
        'Posa\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Posa',
        ),
        'App\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Models',
        ),
        'App\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app/Controllers',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitfa0fd671a30fa01466b5e2c3d07c5179::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitfa0fd671a30fa01466b5e2c3d07c5179::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
