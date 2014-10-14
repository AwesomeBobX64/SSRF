<?php

/**
 * Shorten the DIRECTORY_SEPARATOR constant.
 *
 * @var string
 */
define('DS', DIRECTORY_SEPARATOR);
/**
 * The root project directory.
 *
 * @var string
*/
define('BASE_DIR', dirname(__DIR__));
/**
 * The root class directory.
 *
 * @var string
*/
define('CLASS_DIR', BASE_DIR . DS . 'classes');
/**
 * The root trait directory.
 *
 * @var string
*/
define('TRAIT_DIR', BASE_DIR . DS . 'traits');
/**
 * The root interface directory.
 *
 * @var string
*/
define('INTERFACE_DIR', BASE_DIR . DS . 'interfaces');
/**
 * The root test directory.
 *
 * @var string
*/
define('TEST_DIR', BASE_DIR . DS . 'tests');

/**
 * Class, interface and test autoloader.
 */
spl_autoload_register(function ($object)
{
    foreach ([CLASS_DIR, TRAIT_DIR, INTERFACE_DIR, TEST_DIR] as $rootDir)
    {
        $fileName = $rootDir . DS . str_replace('\\', DS, $object) . '.php';

        if (file_exists($fileName))
        {
            return require $fileName;
        }
    }

    return FALSE;
});

function isset_or($var = NULL, $or = NULL)
{
    return isset($var) ? $var : $or;
}