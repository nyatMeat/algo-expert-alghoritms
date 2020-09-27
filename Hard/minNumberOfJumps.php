<?php
function minNumberOfJumps(array $array)
{
	if (count($array) === 1)
	{
		return 0;
	}
	$jumps = 0;
	$maxReach = $array[0];
	$steps = $array[0];
	for ($i = 1; $i < count($array) - 1; $i++)
	{
		$maxReach = max($maxReach, $i + $array[$i]);
		$steps--;
		if ($steps == 0)
		{
			$jumps += 1;
			$steps = $maxReach - 1;
		}
	}
	return $jumps + 1;
}
