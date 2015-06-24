<?php

require_once 'common.php';

use Dapphp\TorUtils\DirectoryClient;

$client = new DirectoryClient();

$descriptor = $client->getServerDescriptor('FE32CAC855ABC707ED7FEDAF720046FE914EB491');

echo sprintf("%-19s %40s\n", $descriptor->nickname, $descriptor->fingerprint);
echo sprintf("Running %s\n", $descriptor->platform);
echo sprintf("Online for %s\n", uptimeToString($descriptor->getCurrentUptime(), false));
echo sprintf("OR Address: %s:%s", $descriptor->ip_address, $descriptor->or_port);

if ($descriptor->or_address) {
    foreach ($descriptor->or_address as $address) {
        echo ", $address";
    }
}
echo "\n";

echo sprintf("Exit Policy:\n  Accept:\n    %s\n  Reject:\n    %s\n",
             implode("\n    ", $descriptor->exit_policy4['accept']),
             implode("\n    ", $descriptor->exit_policy4['reject'])
);
