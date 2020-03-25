<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/25/2020
 * Time: 8:08 PM
 */

namespace App\Sblog\Core;


trait Tsingletone
{
    //use Tsingletone;
    private static $instance;

    public static function instance(){
        if (self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }
}