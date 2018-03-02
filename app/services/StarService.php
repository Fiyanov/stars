<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 17:28
 */

class StarService extends \Phalcon\DI\Injectable
{
    public function getList($filter = [], $limit = 20)
    {
        $result = [];
        $persons = Persons::find(['limit' => $limit]);

        foreach ($persons as $person) {
            $result[] = [
                'name' => $person->name
            ];
        }

        return $result;
    }

    public function getPerson($id)
    {
        return false;
    }
}