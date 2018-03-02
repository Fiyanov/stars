<?php
/**
 * Created by PhpStorm.
 * User: x49x46
 * Date: 02.03.2018
 * Time: 13:38
 */

use Phalcon\Mvc\Model;

class Persons extends Model
{
    public $id;
    public $name;
    public $birthday;
    public $birthplace;
    public $country;
    public $career_status;
    public $color_eye;
    public $color_hair;
    public $height;

    public function initialize()
    {
        $this->hasMany(
            "id",
            "Aliases",
            "person_id"
        );

        $this->hasMany(
            "id",
            "Images",
            "person_id"
        );

        $this->hasMany(
            "id",
            "SocialPages",
            "person_id"
        );
    }
}