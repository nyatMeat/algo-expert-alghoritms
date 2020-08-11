<?php
/**
 * O(n) - time
 * O(1) - space
 * @param array $array
 * @return bool
 */
function singleCycleCheck(array $array): bool
{
	$length = count($array);
	$visited = 0;
	$currentIdx = 0;
	$getNextIdxFunc = function ($array, $currentIdx)
	{
		$cnt = count($array);
		$jump = $array[$currentIdx];
		$nextIdx = ($currentIdx + $jump) + $cnt;
		return $nextIdx >= 0 ? $nextIdx : $nextIdx + $cnt;
	};
	while ($visited < $length)
	{
		if ($visited > 0 && $currentIdx == 0)
		{
			return false;
		}
		$visited++;
		$currentIdx = $getNextIdxFunc($array, $currentIdx);
	}

	return $currentIdx == 0;
}
