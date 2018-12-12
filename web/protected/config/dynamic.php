<?php return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\\db\\Connection',
      'dsn' => 'mysql:host=localhost;dbname=sherbuy',
      'username' => 'root',
      'password' => '',
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
        'installer_hostname' => 'localhost',
        'installer_database' => 'sherbuy',
      ),
    ),
    'config_created_at' => 1544640521,
    'horImageScrollOnMobile' => '1',
    'databaseInstalled' => true,
    'installed' => true,
  ),
  'name' => 'Sherbuy',
  'language' => 'fr',
  'timeZone' => 'UTC',
); ?>