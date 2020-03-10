<?php
$db_conf = parse_ini_file('/etc/asterisk/cdr_mysql.conf',1)['global'];

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . $db_conf['hostname'] . ';dbname=' . $db_conf['dbname'],
    'username' => $db_conf['user'],
    'password' => $db_conf['password'],
    'charset' => 'utf8',
];