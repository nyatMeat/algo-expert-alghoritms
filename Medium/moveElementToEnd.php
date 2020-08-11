<?php
/**
 * move element of array to end
 * O(n) time| O(1) space
 * @param array $arr
 * @param int $value
 * @return array
 */
function moveElementToEnd(array $arr, int $value): array
{
	$cnt = count($arr);
	$i = 0;
	$j = $cnt - 1;
	while ($i < $j)
	{
		if ($arr[$j] == $value)
		{
			$j--;
		}
		if ($arr[$i] == $value)
		{
			$temp = $arr[$j];
			$arr[$j] = $arr[$i];
			$arr[$i] = $temp;
		}
		$i++;
	}
	return $arr;

}
