<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/25/2020
 * Time: 8:17 PM
 */

namespace App\Sblog\Core;


class BlogApp
{
    public  static  $app;

    public static function get_instance(){
        self::$app = Registry::instance();
        self::getParams();
        return self::$app;
    }

    protected static function getParams(){
        $params = require CONF . '/params.php';
        if (!empty($params)){
            foreach ($params as $k => $v){
                self::$app->setProperty($k, $v);
            }
        }
    }
}