<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitac11b550fbb18181702d2ca4a3dd9a07
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitac11b550fbb18181702d2ca4a3dd9a07::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitac11b550fbb18181702d2ca4a3dd9a07::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitac11b550fbb18181702d2ca4a3dd9a07::$classMap;

        }, null, ClassLoader::class);
    }
}