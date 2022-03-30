<?php

class AutoloadExceptFail extends \Exception
{}


class Test
{
    /**
     * OK
     */
    protected function testFullPathIOk(): void
    {
        new TestClass1(); // clear
    }

    /**
     * Non-existent call class
     * @throws AutoloadExceptFail
     */
    protected function testFullPathFail(): void
    {
        try {
            new TestClass1F(); // extend
            throw new AutoloadExceptFail('Pass for non-existent class!');
        } catch (AutoloadExcept $ex) {
            // OK
        }
    }

    /**
     * Non-existent base class
     * @throws AutoloadExceptFail
     */
    protected function testFullPathFailExtend(): void
    {
        try {
            new TestClass2F(); // extend
            throw new AutoloadExceptFail('Pass for non-existent extend!');
        } catch (AutoloadExcept $ex) {
            // OK
        }
    }

    /**
     * Non-existent interface
     * @throws AutoloadExceptFail
     */
    protected function testFullPathFailInterface(): void
    {
        try {
            new TestClass3F(); // interface
            throw new AutoloadExceptFail('Pass for non-existent interface!');
        } catch (AutoloadExcept $ex) {
            // OK
        }
    }

    /**
     * Non-existent trait in class
     * @throws AutoloadExceptFail
     * Currently problems with testing non-existent traits
     */
    protected function testFullPathFailTrait(): void
    {
        try {
            new TestClass4F(); // trait
            throw new AutoloadExceptFail('Pass for non-existent trait!');
        } catch (AutoloadExcept $ex) {
            // OK
        }
    }

    public static function autoload(): void
    {
        require_once __DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php';
        spl_autoload_register('Autoload::autoloading');
    }

    /**
     * @throws AutoloadExceptFail
     */
    public static function run(): void
    {
        $data = new self;
        $data->testFullPathFail();
        $data->testFullPathFailExtend();
        $data->testFullPathFailInterface();
        $data->testFullPathFailTrait();
        echo 'OK' . PHP_EOL;
    }
}

Test::autoload();
Test::run();
