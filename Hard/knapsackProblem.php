<?php
function knapsackProblem(array $items, int $capacity)
{

	$knapsackValues = [];
	for ($i = 0; $i < count($items); $i++)
	{
		$knapsackValues[] = array_fill(0, $capacity + 1, 0);
	}
	for ($i = 1; $i < count($items); $i++)
	{
		$currentValue = $items[$i - 1][0];
		$currentWeight = $items[$i - 1][1];
		for ($c = 0; $c < $capacity; $c++)
		{
			if ($currentWeight > $c)
			{
				$knapsackValues[$i][$c] = $knapsackValues[$i - 1][$c];
			}
			else
			{
				$knapsackValues[$i][$c] = max($knapsackValues[$i - 1][$c], $knapsackValues[$i - 1][$c - $currentWeight] + $currentValue);
			}
		}

	}
	return [$knapsackValues[count($items)][$capacity], getKnapsackItems($knapsackValues, $items)];

}

function getKnapsackItems($knapsackValues, $items)
{
	$sequence = [];
	$i = count($knapsackValues) - 1;
	$c = count($knapsackValues[0]) - 1;
	while ($i > 0)
	{
		if ($knapsackValues[$i][$c] === $knapsackValues[$i - 1][$c])
		{
			$i -= 1;
		}
		else
		{
			array_unshift($sequence, [$i - 1]);
			$c -= $items[$i - 1][1];
			$i -= 1;
		}
		if ($c === 0)
		{
			break;
		}
	}
	return $sequence;
}
