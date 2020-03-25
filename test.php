<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 3/14/2020
 * Time: 2:10 PM
 */
require_once "simplevk-master/autoload.php"; //Подключаем библиотеку
use DigitalStar\vk_api\vk_api; // Основной класс
use DigitalStar\vk_api\Coin; // работа с vkcoins
use DigitalStar\vk_api\LongPoll; //работа с longpoll
use DigitalStar\vk_api\Execute; // Поддержка Execute
use DigitalStar\vk_api\Group; // Работа с группами с ключем пользователя
use DigitalStar\vk_api\Auth; // Авторизация
use DigitalStar\vk_api\Post; // Конструктор постов
use DigitalStar\vk_api\Message; // Конструктор сообщений
use DigitalStar\vk_api\VkApiException; // Обработка ошибок

//print phpinfo();
//exit;
include 'inc/safemysql.class.php';

$db     = new SafeMysql();

$table  = "users";
$sql = "CREATE TABLE `users` (`ansid` bigint(20) NOT NULL COMMENT 'id данного ответа',
`qsn` int(10) NOT NULL DEFAULT '0' COMMENT 'номер вопроса',
`ball` int(20) NOT NULL COMMENT 'балы для дальнейшего подсчета',
`eid` varchar(20) NOT NULL COMMENT 'группа вопроса',
`userid` varchar(27) NOT NULL,
`date` varchar(12) NOT NULL,
`ip` int(10) UNSIGNED NOT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
$db->query($sql);

//$fields = ['id', 'login', 'pass'];

//$vk = vk_api::create('37125342029', 'o8g*&g8&G8&8&F087', '5.103');
//$content = $vk->request('users.search', ['sort'=>1, 'country'=>12, 'online'=>1, 'per_page'=>40, 'photo'=>1, 'section'=>'people', 'status'=>5]);
//print_r ($content);
?>