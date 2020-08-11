<?php
/**
 * O(n^2) - time
 * O(n) - size
 * @param array $arr
 * @param int $sum
 * @return array
 */
function threeNumberSum(array $arr, int $sum):array
{
	$result = [];
	sort($arr);
	$cnt = count($arr);
	for ($i = 0; $i < $cnt - 2; $i++)
	{

		$left = $i + 1;
		$right = $cnt - 1;
		while ($left < $right)
		{
			$currSum = $arr[$i] + $arr[$left] + $arr[$right];
			if ($currSum > $sum)
			{
				$right--;
			}
			elseif ($currSum < $sum)
			{
				$left++;
			}
			else
			{
				$result[] = [$arr, $arr[$left], $arr[$right]];
			}
		}


	}
	return $result;
}
