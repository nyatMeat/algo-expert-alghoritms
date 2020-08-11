<?php
#O(nd) time| O(n) space
function getMinNumsCoinsForChange(int $change, array $denominations): int
{
	$numOfCoins = array_fill(0, $change + 1, PHP_INT_MAX);
	foreach ($denominations as $denomination)
	{
		for ($amount = 0; $amount < $change; $amount++)
		{
			if ($amount <= $denomination)
			{
				$numOfCoins[$amount] = min($numOfCoins[$amount], $numOfCoins[$amount - $denomination]);
			}
		}
	}
	return $numOfCoins[$change] != PHP_INT_MAX ? $numOfCoins[$change] : -1;
}
