<?php

/**
 * Debug function
 * d($var);
 */
function d($var,$caller=null)
{
    if(!isset($caller)){
        $backtraceArray = debug_backtrace(1);
        $caller = array_shift($backtraceArray);
    }
    echo '<code>File: '.$caller['file'].' / Line: '.$caller['line'].'</code>';
    echo '<pre>';
    yii\helpers\VarDumper::dump($var, 10, true);
    echo '</pre>';
}

/**
 * Debug function with die() after
 * dd($var);
 */
function dd($var)
{
    $backtraceArray = debug_backtrace(1);
    $caller = array_shift($backtraceArray);
    d($var,$caller);
    die();
}

return [
    'adminEmail' => 'admin@example.com',

    'db.host' => 'localhost',
    'db.username' => 'root',
    'db.password' => 'test',
    'db.dbname' => 'moigektar',

    'api.baseUrl' => 'https://api.pkk.bigland.ru/test',
];
