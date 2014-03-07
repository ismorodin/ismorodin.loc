<?php
function nums($one,$two,&$min,&$ymnoj,&$div){
	$min = $one - $two;
	$ymnoj = $one * $two;
	$div = $one / $two;
	return $one +$two;
}
$x = nums(5,2,$a,$b,$c);
echo $x;
echo $nn;