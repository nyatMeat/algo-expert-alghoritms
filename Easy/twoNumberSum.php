<?php
/**
 * Solution with hash table
 * O(n) - time
 * O(n) - memory
 * @param array $arr
 * @param $sum
 * @return array
 */
function twoNumberSum(array $arr, int $sum): array
{
	$hash = [];
	foreach ($arr as $value)
	{
		$hash[$value] = $value;
	}
	$result = [];
	foreach ($arr as $item)
	{
		$y = $sum - $item;
		if (isset($hash[$y]) && $hash[$y] !== $item)
		{
			$result = [$item, $hash[$y]];
			break;
		}
	}
	return $result;
}

/**
 * s
 * O(log(n)) - time
 * O(1) - memory
 * @param array $arr
 * @param $sum
 * @return array
 */
function twoNumberSumSorted(array $arr, int $sum): array
{
	$left = 0;
	$right = count($arr) - 1;
	while ($left < $right)
	{
		$tempSum = $arr[$left] + $arr[$right];

		if ($tempSum > $sum)
		{
			$right--;
		}
		elseif ($tempSum < $sum)
		{
			$left++;
		}
		else
		{
			return [$arr[$left], $arr[$right]];
		}
	}
	return [];
}
