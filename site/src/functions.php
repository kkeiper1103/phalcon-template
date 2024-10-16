<?php

namespace App;

use Phalcon\Mvc\Router\Group;

function group(array $attributes, callable $definition) {
    $group = new Group();

    if($attributes['prefix']) $group->setPrefix($attributes['prefix']);

    return $definition($group);
}