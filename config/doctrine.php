<?php declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

\Doctrine\DBAL\Types\Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

$paths = [BASE_PATH . '/src/Infrastructure/Database/Doctrine/Model'];
$isDevMode = true;

$dbParams = [
    'driver' => 'pdo_sqlite',
    'path' => BASE_PATH . '/database/sqlite3/database.sqlite'
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$entityManager = new EntityManager($connection, $config);

