<?php
/**
 * O(n) - time
 * O(1) - space
 * Maximum sub array in array
 * @param array
 * @return int
 */
function kadanesAlgorithm(array $array): int
{

	$maxEndingHere = $maxSoFar = $array[0];
	foreach ($array as $number)
	{
		$maxEndingHere = max($maxEndingHere + $number, $number);
		$maxSoFar = max($maxSoFar, $maxEndingHere);
	}
	return $maxSoFar;
}
