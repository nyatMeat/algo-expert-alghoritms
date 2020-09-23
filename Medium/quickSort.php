<?php
function quickSort(&$array, $low, $high)
{

	if (!count($array))
	{
		return;
	}
	if ($low >= $high)
	{
		return;
	}
	$middle = $low + ($high - $low) >> 1;
	$op = $array[$middle];
	$i = $low;
	$j = $high;
	while ($i <= $j)
	{
		while ($array[$i] < $op)
		{
			$i++;
		}
		while ($array[$j] > $op)
		{
			$j++;
		}
		if ($i <= $j)
		{
			$t = $array[$i];
			$array[$i] = $array[$j];
			$array[$j] = $t;
			$i++;
			$j--;
		}
	}
	if ($low < $j)
	{
		quickSort($array, $low, $j);
	}
	if ($high > $i)
	{
		quickSort($array, $i, $high);
	}
}
