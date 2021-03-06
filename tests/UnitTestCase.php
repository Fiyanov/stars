<?php
use Phalcon\Di;
use Phalcon\Test\UnitTestCase as PhalconTestCase;

abstract class UnitTestCase extends PhalconTestCase
{
    /**
     * @var bool
     */
    private $_loaded = false;

    public function setUp()
    {
        parent::setUp();

        // Загрузка дополнительных сервисов, которые могут потребоваться во время тестирования
        $di = Di::getDefault();

        // получаем любые компоненты DI, если у вас есть настройки, не забудьте передать их родителю

        $this->setDi($di);

        $this->_loaded = true;
    }

    /**
     * Проверка на то, что тест правильно настроен
     *
     * @throws \PHPUnit_Framework_IncompleteTestError;
     */
    public function __destruct()
    {
        if (!$this->_loaded) {
            throw new \PHPUnit_Framework_IncompleteTestError(
                "Please run parent::setUp()."
            );
        }
    }
}