<?php
/**
 * Алгоритм Евклида
 * @param $p
 * @param $q
 * @return mixed
 */
function gcd($p, $q)
{
	return $q === 0 ? $p : gcd($q, $p % $q);
}
