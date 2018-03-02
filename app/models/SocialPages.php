<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 13:40
 */
use Phalcon\Mvc\Model;

class SocialPages extends Model
{
    public $id;
    public $person_id;
    public $url;

    public function initialize()
    {
        $this->hasOne(
            "person_id",
            "Persons",
            "id"
        );
    }
}