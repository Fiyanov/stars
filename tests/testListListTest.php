<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 17:20
 */

class ListTest extends \UnitTestCase
{
    public function testListCase()
    {
        $this->assertEquals(
            true,
            is_array((new StarService())->getList()),
            'Array required!'
        );

        $result = (new StarService())->getPersona(1);

        $this->assertEquals(
            true,
            is_array($result) || is_bool($result)  ,
            'Result must be filled'
        );
    }
}