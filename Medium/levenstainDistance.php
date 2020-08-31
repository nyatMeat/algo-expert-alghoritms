<?php
function levenshteinDistance(string $first, string $second): int
{
	$first = str_split($first);
	$second = str_split($second);
	$cntFirst = count($first);
	$cntSecond = count($second);

	$cur = array_fill(0, $cntFirst + 1, 0);
	$prev = array_fill(0, $cntSecond + 1, 0);
	for ($n = 0; $n <= $cntFirst; $n++)
	{
		for ($m = 0; $m <= $cntSecond; $m++)
		{

			if ($n == 0 && $m == 0)
			{
				$cur[$m] = 0;
			}
			else
			{
				$result = PHP_INT_MAX;
				if ($m > 0)
				{
					$result = min($result, $cur[$m - 1] + 1);
				}
				if ($n > 0)
				{
					$result = min($result, $prev[$m] + 1);
				}
				if ($n > 0 && $m > 0)
				{
					$result = min($result, $prev[$m - 1] + ($first[$n - 1] == $second[$m - 1] ? 0 : 1));
				}
				$cur[$m] = $result;
			}
		}
		$temp = $cur;
		$cur = $prev;
		$prev = $temp;
	}
	return $prev[$cntSecond];
}
