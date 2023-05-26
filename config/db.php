<?php
/** @var $params array */

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host='.$params['db.host'].';dbname='.$params['db.dbname'],
    'username' => $params['db.username'],
    'password' => $params['db.password'],
    'charset' => 'utf8',
];