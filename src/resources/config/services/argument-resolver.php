<?php

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Untek\Core\Instance\Fork\Resolution\ConstraintResolver;
use Untek\Core\Instance\Libs\Resolvers\ArgumentDescriptor;
use Untek\Core\Instance\Libs\Resolvers\ArgumentMetadataResolver;
use Untek\Core\Kernel\Config\CallableConfigLoader;
use Untek\Core\Instance\Libs\Resolvers\InstanceResolver;
use Untek\Core\Instance\Libs\InstanceProvider;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $configurator): void {
    $services = $configurator->services();


    $services->set(InstanceResolver::class, InstanceResolver::class);
    $services->set(InstanceProvider::class, InstanceProvider::class)
        ->args([
            service(ContainerInterface::class),
            service(InstanceResolver::class),
        ]);

    $services->set(ArgumentDescriptor::class, ArgumentDescriptor::class);
    $services->set(ConstraintResolver::class, ConstraintResolver::class);
    $services->set(ArgumentMetadataResolver::class, ArgumentMetadataResolver::class)
        ->args(
            [
                service(ContainerInterface::class),
                service(ArgumentDescriptor::class),
                service(ConstraintResolver::class),
            ]
        );
    $services->set(CallableConfigLoader::class, CallableConfigLoader::class)
        ->args(
            [
                service(ArgumentMetadataResolver::class)
            ]
        );
};