<?php declare(strict_types=1);

require_once BASE_PATH . '/vendor/autoload.php';

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

$paths = [BASE_PATH . '/src/Infrastructure/Database/Doctrine/Model'];
$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_sqlite',
    'path' => BASE_PATH . '/database/sqlite3/database.sqlite'
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);


