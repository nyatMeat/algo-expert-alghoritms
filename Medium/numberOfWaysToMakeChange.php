<?php
/**
 * O(nd) time
 * O(n) space
 * @param int $sum
 * @param array $denominations
 * @return mixed
 */
function numberOfWaysToMakeChange(int $sum, array $denominations): int
{
	$ways = array_fill(0, $sum, 0);
	$ways[0] = 1;
	foreach ($denominations as $denomination)
	{
		for ($amount = 1; $amount < $sum; $amount++)
		{
			if ($denomination <= $amount)
			{
				$ways[$amount] += $ways[$amount - $denomination];
			}
		}
	}
	return $ways[$sum];
}
