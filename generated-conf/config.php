<?php
$serviceContainer = \Propel\Runtime\Propel::getServiceContainer();
$serviceContainer->checkVersion('2.0.0-dev');
$serviceContainer->setAdapterClass('RPIWannaHangOut', 'mysql');
$manager = new \Propel\Runtime\Connection\ConnectionManagerSingle();
$manager->setConfiguration(array (
  'classname' => 'Propel\\Runtime\\Connection\\ConnectionWrapper',
  'dsn' => 'mysql:host=localhost;dbname=RPIWannaHangOut',
  'user' => 'propel_user',
  'password' => 'HvwE49yK23wKmQ6',
  'attributes' =>
  array (
    'ATTR_EMULATE_PREPARES' => false,
  ),
));
$manager->setName('RPIWannaHangOut');
$serviceContainer->setConnectionManager('RPIWannaHangOut', $manager);
$serviceContainer->setDefaultDatasource('RPIWannaHangOut');