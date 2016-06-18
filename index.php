<style>
    .row{clear:both}
    .w{
        width: 20px;
        height: 20px;
        float:left;
        margin: 2px;
    }
    ul>li{
        list-style-type: none;
        clear:both
    }
</style>
<?php

$warehouses = [
    'palegreen',
    'lightskyblue',
    'fuchsia',
    'crimson',
    'darkgreen',
    'gray'
];

echo '<p>Warehouses:</p>';
echo '<ul>';
foreach($warehouses as $warehouse){
    echo "<li><span class='w' style='background-color: {$warehouse}'></span>{$warehouse}</li>";
}
echo '</ul>';

$routes_array = recurciveCalculate($warehouses);

echo '<p>Кол-во вариантов -'.count($routes_array).' <p>';

foreach($routes_array as $key=>$routes){
    $pp = '<div class="w">'.++$key.'</div>';
    echo '<div class="row">'.$pp;
    foreach($routes as $warehouse){
        echo "<div class='w' style='background-color: {$warehouse}'></div>";
    }
    echo '</div>';
}


function recurciveCalculate($warehouses,$routes=[]){
    if(empty($warehouses)) return $routes;
    $routes_tmp=[];
    foreach($warehouses as $key=>$warehouse){
        $routes_iteration = [];

        if(empty($routes)){
            $routes_iteration[]=[$warehouse];
        }else{
            foreach($routes as $route){
                $route[] = $warehouse;
                $routes_iteration[] = $route;
            }
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

