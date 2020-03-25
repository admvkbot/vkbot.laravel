<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/25/2020
 * Time: 8:13 PM
 */

namespace App\Sblog\Core;


class Registry
{
    use Tsingletone;

    protected static $properties = [];

    public function setProperty($name, $value){
        self::$properties[$name] = $value;
    }

    public function getProperty($name){
        if (isset(self::$properties[$name])){
            return self::$properties[$name];
        }
        return null;
    }

    public function getProperties(){
        return self::$properties;
    }

}