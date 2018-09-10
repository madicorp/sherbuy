<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=mysqldb;dbname=test',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
    ),
    'user' => 
    array (
    ),
    'mailer' => 
    array (
      'transport' => 
      array (
        'class' => 'Swift_MailTransport',
      ),
    ),
    'cache' => 
    array (
      'class' => 'yii\\caching\\FileCache',
      'keyPrefix' => 'humhub',
    ),
    'formatter' => 
    array (
      'defaultTimeZone' => 'UTC',
    ),
    'formatterApp' => 
    array (
      'defaultTimeZone' => 'UTC',
      'timeZone' => 'UTC',
    ),
  ),
  'params' => 
  array (
    'installer' => 
    array (
      'db' => 
      array (
        'installer_hostname' => 'mysqldb',
        'installer_database' => 'test',
      ),
    ),
    'config_created_at' => 1535227800,
    'horImageScrollOnMobile' => '1',
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'SHERBUY',
  'language' => 'fr',
  'timeZone' => 'UTC',
); ?>