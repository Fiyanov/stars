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
    }

    public function testPersonCase()
    {
        $result = (new StarService())->getPersona(1);

        $this->assertEquals(
            true,
            (is_array($result) && !empty($result)) || is_bool($result),
            'Result must be filled array or boolean'
        );

        if ($result) {
            $this->assertCount(
                1,
                $result,
                'Result must have only one item'
            );
        } else {
            $this->assertEquals(
                false,
                $result,
                'Result must be "false" if nothing to find'
            );
        }
    }
}