<?php declare(strict_types=1);

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

\Doctrine\DBAL\Types\Type::addType('uuid', 'Ramsey\Uuid\Doctrine\UuidType');

$paths = [
    BASE_PATH . '/src/Infrastructure/Checkout/Model/Doctrine',
    BASE_PATH . '/src/Infrastructure/Customer/Model/Doctrine',
    BASE_PATH . '/src/Infrastructure/Product/Model/Doctrine',

];
$isDevMode = in_array($_ENV['APP_ENV'], ['develop', 'testing']);

$dbParams = [
    'driver' => $_ENV['DB_CONNECTION'],
    'path' => $_ENV['DB_URL'] === ':memory:' ? $_ENV['DB_URL'] : BASE_PATH . $_ENV['DB_URL']
];

$config = ORMSetup::createAttributeMetadataConfiguration($paths, $isDevMode);
$connection = DriverManager::getConnection($dbParams, $config);
$GLOBALS['entity_manager'] = $entityManager = new EntityManager($connection, $config);

if (! function_exists('get_entity_manager')) {
    function get_entity_manager(): EntityManager
    {
        return $GLOBALS['entity_manager'];
    }
}
