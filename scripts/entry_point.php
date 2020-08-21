<?php

require __DIR__ . '/../app/Concerns/Entity.php';
require __DIR__ . '/../app/Entities/Host.php';

$__host_reviewer_checker = function (int $domainId) {
    // Is current Script running on console

    $isConsoleRunning = php_sapi_name() === 'cli';

    // Function for create Host Entity

    $createHostEntity = function (int $domainId) {
        $path = __DIR__ . '/../storage/hosts/'. $domainId . '.json';

        if (!file_exists($path)) {
            throw new LogicException('Config domain #'. $domainId. ' not found!');
        }

        $json = file_get_contents($path);

        return \App\Entities\Host::createFromJson($json);
    };

    // Get User Ip Address

    $ip = $_SERVER['REMOTE_ADDR'] ?? ($isConsoleRunning ? '127.0.0.1' : null);

    // Create Host Entity

    $host = $createHostEntity($domainId);

    if (!$host->isAccess($ip)) {
        die();
    }
};

$__host_reviewer_checker(4);
