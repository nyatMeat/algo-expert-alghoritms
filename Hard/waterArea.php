<?php
/**
 * Задача на динамическое программирование
 * @param array $array
 * @return int
 */
function waterArea(array $array)
{
	$maxes = [];
	$leftMax = 0;
	for ($i = 0; $i < count($array); $i++)
	{
		$maxes[$i] = $leftMax;
		$leftMax = max($leftMax, $array[$i]);


	}
	$rightMax = 0;
	for ($i = count($array) - 1; $i >= 0; $i--)
	{
		$height = $array[$i];
		$minHeight = min($maxes[$i], $rightMax);
		if ($minHeight > $height)
		{
			$maxes[$i] = $minHeight - $height;
		}
		else
		{
			$maxes[$i] = 0;
		}

		$rightMax = max($rightMax, $height);
	}
	return array_sum($maxes);
}


