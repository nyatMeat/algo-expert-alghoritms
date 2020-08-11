<?php

function getSmallestDifference(array $array1, array $array2)
{

	$pointer1 = 0;
	$pointer2 = 0;
	sort($array1);
	sort($array2);
	if ($array1[$pointer1] == $array2[$pointer2])
	{
		return 0;
	}
	$smallest = PHP_INT_MAX;
	$current = PHP_INT_MAX;
	$pair = [];
	while ($pointer1 < count($array1) && $pointer2 < count($array2))
	{
		$first = $array1[$pointer1];
		$second = $array2[$pointer2];
		if ($first < $second)
		{
			$current = $second - $first;
			$pointer1++;
		}
		elseif ($first > $second)
		{
			$current = $first - $second;
			$pointer2++;
		}
		else
		{
			return [$array1[$pointer1], $array2[$pointer2]];
		}
		if ($smallest > $current)
		{
			$smallest = $current;
			$pair = [$array1[$pointer1], $array2[$pointer2]];
		}

	}
	return $pair;

}
