<?php

require __DIR__ . '/vendor/autoload.php';

//use Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Jgut\Slim\Doctrine\DocumentManagerBuilder;
use Jgut\Slim\Doctrine\EntityManagerBuilder;

$CLISettings = [
'cache_driver' => new \Doctrine\Common\Cache\VoidCache(),
];
$settings = require __DIR__ . '/src/settings.php';

$entityManager = EntityManagerBuilder::build(array_merge($settings['settings']['doctrine'], $CLISettings));
//$documentManager = DocumentManagerBuilder::build(array_merge($settings['document_manager'], $CLISettings));

return $helperSet = ConsoleRunner::createHelperSet($entityManager);
//$helperSet->set(new DocumentManagerHelper($documentManager), 'dm');
//
//$cli = ConsoleRunner::createApplication($helperSet, [
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateDocumentsCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateRepositoriesCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\ClearCache\MetadataCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\CreateCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\DropCommand(),
//new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\UpdateCommand(),
//]);