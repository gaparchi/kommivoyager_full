<?php

$warehouses = ['red','green','blue'];

echo "<pre>\n";

print_r(recurciveCalculate($warehouses,[['1'],['2']]));
echo '</pre>';
exit();


function recurciveCalculate($warehouses,$routes){
    if(empty($warehouses)) return $routes;
    $routes_tmp=[];
    foreach($warehouses as $key=>$warehouse){
        $routes_iteration = [];
        foreach($routes as $route){
            $route[] = $warehouse;
            $routes_iteration[] = $route;
        }
        $warehouses_next_iteration = $warehouses;
        unset($warehouses_next_iteration[$key]);
        $routes_tmp = array_merge(
            $routes_tmp,
            recurciveCalculate( $warehouses_next_iteration, $routes_iteration)
        );
    }
    return $routes_tmp;
}

