<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 17:28
 */

class StarService extends \Phalcon\DI\Injectable
{
    public function getList($ids = [], $limit = 20)
    {
        $result = [];
        $condition = '';

        if ($ids) {
            $condition = 'id IN ({ids:array})';
        }

        $persons = Persons::find([
            $condition,
            'bind' => [
                'ids' => $ids
            ],
            'limit' => $limit
        ]);

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

    public function search($search)
    {
        $persons_ids = [];
        $aliases = Aliases::find(['conditions' => "alias LIKE '%$search%'"]);

        foreach ($aliases as $alias) {
            $persons_ids[] = $alias->person_id;
        }

        $persons = Persons::find(['conditions' => "name LIKE '%$search%'"]);

        foreach ($persons as $person) {
            $persons_ids[] = $person->id;
        }

        return $this->getList($persons_ids);
    }
}