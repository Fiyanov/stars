<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 13:27
 */

use Phalcon\Mvc\Model;

class Aliases extends Model
{
    public $id;
    public $person_id;
    public $alias;

    public function initialize()
    {
        $this->hasOne(
            "person_id",
            "Persons",
            "id"
        );
    }
}