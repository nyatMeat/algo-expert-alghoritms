<?php
/**
 * get fibonacci number value
 * O(n) - time
 * O(1) - memory
 * @param $n
 * @return int
 */
function fib(int $n): int
{
	if ($n <= 2)
	{
		return 1;
	}
	$f1 = 1;
	$f2 = 1;
	for ($i = 2; $i < $n; $i++)
	{
		$f3 = $f2;
		$f2 = $f1 + $f2;
		$f1 = $f3;
		$f3 = 0;
	}
	return $f2;
}
