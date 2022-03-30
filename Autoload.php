<?php

// simple source for testing autoloading

// for catching
class AutoloadExcept extends \Exception
{}

// autoload itself
class Autoload
{
    static $testingMode = true;

    /**
     * @param string $className
     * @throws AutoloadExcept
     */
    public static function autoloading(string $className): void
    {
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'load' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className).'.php';
        if (file_exists($file)) {
            require $file;
            return;
        }

        if (static::$testingMode) {
            throw new AutoloadExcept(sprintf('Class not found. Class name: %s', $className));
        }
    }
}
