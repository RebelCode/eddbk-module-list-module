<?php

use Psr\Container\ContainerInterface;
use RebelCode\EddBookings\Module\ModulesListModule;

define('EDDBK_MODULE_LIST_MODULE_DIR', __DIR__);

return function(ContainerInterface $c) {
    return new ModulesListModule($c->get('container-factory'));
};
