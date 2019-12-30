<?php

function buildForest($nodeCenter, $nums){
    $nodeCenterArr = array($nodeCenter);
    $nodes = array($nodeCenter);
    $count = 0;
    while($count<$nums){
            $nodes = array_merge($nodes, getNextNodes($nodeCenter));
            $nodes = array_unique($nodes);
            $count = count($nodes);
            array_push($nodeCenterArr, $nodeCenter);
            $nodeCenterArr = array_unique($nodeCenterArr);
            $randArray = array_diff($nodes, $nodeCenterArr);
            if($randArray){
                $randKey = array_rand($randArray,1);
                $nodeCenter = $randArray[$randKey];
            }
    }
    return $nodes;
}

function getNextNodes($nodeCenter){
    $nx = getX($nodeCenter);
    $ny = getY($nodeCenter);
    //$nextNodes = array(makeCoordinate($nx-1,$ny-1),makeCoordinate($nx+1,$ny-1),makeCoordinate($nx,$ny-1),makeCoordinate($nx+1,$ny),makeCoordinate($nx-1,$ny),makeCoordinate($nx-1,$ny+1),makeCoordinate($nx+1,$ny+1),makeCoordinate($nx,$ny+1));
    $nextNodes = array(makeCoordinate($nx,$ny-1),makeCoordinate($nx+1,$ny),makeCoordinate($nx-1,$ny),makeCoordinate($nx,$ny+1));
    $an = rand(2,4);
    //$an = rand(2,8);
    $rand_keys = array_rand($nextNodes, $an);
    foreach($rand_keys as $k){
        $nodes[] = $nextNodes[$k] ;
    }
    return $nodes;
}


function makeCoordinate($x, $y){
    $x = intval($x);
    $y = intval($y);
    $x = $x<0?0:$x;
    $y = $y<0?0:$y;
    $x = $x>99?99:$x;
    $y = $y>99?99:$y;    
    $x = $x<10?'0'.$x:$x;
    $y = $y<10?'0'.$y:$y;
    return '#'.$x.$y;

}

function getX($coordinate){
    return substr($coordinate, 1, 2);
}

function getY($coordinate){
    return substr($coordinate, 3, 2);
}

$coordinate = makeCoordinate(25,25);
$foreast = buildForest($coordinate, 400);
echo '<table width="1000" height="1000" border="0">';
for($i=0;$i<100;$i++){
    echo '<tr>';
    for($j=0;$j<100;$j++){
        echo '<td width="10" height="10" >';
        if(in_array(makeCoordinate($i,$j),$foreast)){
            echo '<img src="http://blog.163.com/zhukeqing_1984/blog/tree.jpg" width="10" height="10"  >';
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</table>';

?>
