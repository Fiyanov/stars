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
                'id' => $person->id,
                'label' => $person->name,
                'value' => $person->id
            ];
        }

        return $result;
    }

    public function getPerson($id)
    {
        $person = Persons::findFirst($id);

        if (!$person) {
            return false;
        }

        $result = $person->toArray();

        $result['career_status'] = boolval($result['career_status']);

        foreach ($person->Aliases as $alias) {
            $result['aliases'][] = $alias->alias;
        }

        foreach ($person->Images as $image) {
            $result['images'][] = $image->image;
        }

        $have_pages = false;

        foreach ($person->SocialPages as $page) {
            $have_pages = true;
            $result['pages'][] = $page->url;
        }

        $result['have_pages'] = $have_pages;

        return $result;
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