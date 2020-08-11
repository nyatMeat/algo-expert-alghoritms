<?php
function factorial(int $n): int
{

	if ($n == 0)
	{
		return 0;
	}
	if ($n == 1)
	{
		return 1;
	}
	$r = 1;
	for ($i = 1; $i <= $n; $i++)
	{
		$r *= $i;
	}
	return $r;

}
