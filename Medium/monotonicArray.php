<?php
#O(n) time| O(1) space
function monotonicArray(array $array): bool
{

	$cnt = count($array);
	$isNonInc = true;
	$isNonDec = true;
	for ($i = 0; $i < $cnt; $i++)
	{
		if ($array[$i] < $array[$i - 1])
		{
			$isNonDec = false;
		}
		if ($array[$i] > $array[$i - 1])
		{
			$isNonInc = false;
		}

	}
	return $isNonInc || $isNonDec;
}
