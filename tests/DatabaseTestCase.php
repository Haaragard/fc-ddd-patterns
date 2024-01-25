<?php declare(strict_types=1);

namespace Tests;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;

abstract class DatabaseTestCase extends TestCase
{
    private static EntityManagerInterface $entityManager;

    public static function setUpBeforeClass(): void
    {
        self::initDatabase();
    }

    public static function tearDownAfterClass(): void
    {
        self::destroyDatabase();
    }

    private static function initDatabase(): void
    {
        self::$entityManager = get_entity_manager();
    }

    private static function destroyDatabase(): void
    {
        self::$entityManager->close();
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function tearDown(): void
    {
        parent::setUp();

        $this->tearDownDatabase();
    }

    private function setUpDatabase(): void
    {
        $metadata = self::$entityManager
            ->getMetadataFactory()
            ->getAllMetadata();

        $tool = new SchemaTool(self::$entityManager);
        $tool->createSchema($metadata);
    }

    private function tearDownDatabase(): void
    {
        $tool = new SchemaTool(self::$entityManager);
        $tool->dropDatabase();
    }

    public function getEntityManager(): EntityManagerInterface
    {
        return self::$entityManager;
    }
}
