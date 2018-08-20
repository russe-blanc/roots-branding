<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit874fdd3b717b12b6509817540bbaed57
{
    public static $prefixLengthsPsr4 = array (
        'R' => 
        array (
            'Roots\\Branding\\' => 15,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Roots\\Branding\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit874fdd3b717b12b6509817540bbaed57::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit874fdd3b717b12b6509817540bbaed57::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
