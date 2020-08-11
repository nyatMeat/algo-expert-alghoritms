<?php
function selectionSort(array $array): array
{
	$currentIdx = 0;
	$cnt = count($array);
	while ($currentIdx < $cnt - 1)
	{
		$smallestIdx = $currentIdx;
		for ($i = $currentIdx + 1; $i < $cnt; $i++)
		{
			if ($array[$smallestIdx] < $array[$i])
			{
				$smallestIdx = $i;
			}
			$tmp = $array[$smallestIdx];
			$array[$smallestIdx] = $array[$currentIdx];
			$array[$currentIdx] = $tmp;
		}
		$currentIdx++;
	}
	return $array;
}
