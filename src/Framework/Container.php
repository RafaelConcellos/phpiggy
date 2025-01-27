<?php
#Container

declare(strict_types=1);

namespace Framework;

use Framework\Exceptions\ContainerExeption;
use ReflectionClass;
use ReflectionNamedType;

class Container
{
    private array $definitions = [];
    private array $resolved = [];

    public function addDefinitions(array $newDefinitions)
    {
        $this->definitions = [...$this->definitions, ...$newDefinitions];
    }

    public function resolve(string $className)
    {
        $reflectionClass = new ReflectionClass($className);

        if (!$reflectionClass->isInstantiable()) {
            throw new ContainerExeption("Class {$className} is not instantiable");
        }

        $constructor = $reflectionClass->getConstructor();

        if (!$constructor) {
            return new $className;
        }

        $params = $constructor->getParameters();

        if (count($params) === 0) {
            return new $className;
        }

        $dependencies = [];

        foreach ($params as $param) {
            $name = $param->getName();
            $type = $param->getType();

            if (!$type) {
                throw new ContainerExeption("Failed to resolve class {$className} because param {$name} is missing a type hint.");
            }


            if (!$type instanceof ReflectionNamedType || $type->isBuiltin()) {
                throw new ContainerExeption("Failed to resolve class {$className} because invalid param type.");
            }

            $dependencies[] = $this->get($type->getName());
        }

        return $reflectionClass->newInstanceArgs($dependencies);
    }

    public function get(string $id)
    {
        if (!array_key_exists($id, $this->definitions)) {
            throw new ContainerExeption("The following class ID does not exist in container.");
        }

        if (array_key_exists($id, $this->resolved)) {
            return $this->resolved[$id];
        }

        $factory = $this->definitions[$id];  # $this->definitions[$id] returns the factory function (arrow function), responsible for generating an instance of the class.
        $dependency = $factory();  # assign the the return value os the factory function to $dependency.

        $this->resolved[$id] = $dependency;

        return $dependency;
    }
}
