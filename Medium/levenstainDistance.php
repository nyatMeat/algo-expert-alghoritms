<?php
function levenshteinDistance(string $first, string $second): int
{
	$cur = array_fill(0, strlen($first) + 1, 0);
	$prev = array_fill(0, strlen($second) + 1, 0);
	for ($n = 0; $n <= strlen($first); $n++)
	{
		for ($m = 0; $m <= strlen($second); $m++)
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
					var_dump(substr($first, $n - 1, 1));
					$result = min($result, $prev[$m - 1] + (substr($first, $n - 1, 1) == substr($second, $m - 1, 1) ? 0 : 1));
				}
				$cur[$m] = $result;
			}
			$temp = $cur;
			$cur = $prev;
			$prev = $temp;
		}
	}
	return $prev[strlen($second)];
}
