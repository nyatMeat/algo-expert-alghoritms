<?php

function pyramid(int $steps)
{
	if ($steps <= 0)
	{
		return '';
	}
	$arr[] = "*";
	for ($i = 1; $i < $steps; $i++)
	{
		$newItem = '*' . $arr[$i - 1] . "*";
		$arr[$i - 1] = str_repeat(' ', $steps - $i) . $arr[$i - 1];
		$arr[$i] = $newItem;
	}
	return implode("\n", $arr);
}
