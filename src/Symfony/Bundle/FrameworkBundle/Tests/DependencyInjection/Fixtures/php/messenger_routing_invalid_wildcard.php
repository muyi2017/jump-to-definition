<?php

$container->loadFromExtension('framework', [
    'http_method_override' => false,
    'serializer' => true,
    'messenger' => [
        'serializer' => [
            'default_serializer' => 'messenger.transport.symfony_serializer',
        ],
        'routing' => [
            'Symfony\*\DummyMessage' => ['audit'],
        ],
        'transports' => [
            'audit' => 'null://',
        ],
    ],
]);
