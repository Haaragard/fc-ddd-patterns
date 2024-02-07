<?php declare(strict_types=1);

define('BASE_PATH', __DIR__ . '/../');

// Autoload
require_once BASE_PATH . '/vendor/autoload.php';

// Doctrine configs
require_once BASE_PATH . '/config/doctrine.php';

// Events configs
require_once BASE_PATH . '/config/events.php';

if (! function_exists('class_has_traits')) {
    /**
     * @param string $class
     * @param string|string[] $traits
     * @return bool
     * @throws \ReflectionException
     */
    function class_has_traits(string $class, string|array $traits): bool
    {
        $reflector = new \ReflectionClass($class);

        return in_array($traits, $reflector->getTraits());
    }
}
