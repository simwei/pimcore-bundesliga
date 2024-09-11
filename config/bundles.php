<?php

use Pimcore\Bundle\DataHubBundle\PimcoreDataHubBundle;
use Pimcore\Bundle\DataImporterBundle\PimcoreDataImporterBundle;
use Pimcore\Bundle\StaticRoutesBundle\PimcoreStaticRoutesBundle;

return [
    //Twig\Extra\TwigExtraBundle\TwigExtraBundle::class => ['all' => true],
    PimcoreDataHubBundle::class => ['all' => true],
    PimcoreDataImporterBundle::class => ['all' => true],
    PimcoreStaticRoutesBundle::class => ['all' => true],
];
