<?php

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.
// Returns the private '.service_locator.vXyj3KZ' shared service.

return $this->privates['.service_locator.vXyj3KZ'] = new \Symfony\Component\DependencyInjection\Argument\ServiceLocator($this->getService, [
    'entityManager' => ['services', 'doctrine.orm.default_entity_manager', 'getDoctrine_Orm_DefaultEntityManagerService', false],
    'parRepo' => ['privates', 'App\\Repository\\PartenaireRepository', 'getPartenaireRepositoryService.php', true],
    'pars' => ['privates', '.errored..service_locator.vXyj3KZ.App\\Entity\\Partenaire', NULL, 'Cannot autowire service ".service_locator.vXyj3KZ": it references class "App\\Entity\\Partenaire" but no such service exists.'],
], [
    'entityManager' => '?',
    'parRepo' => 'App\\Repository\\PartenaireRepository',
    'pars' => 'App\\Entity\\Partenaire',
]);