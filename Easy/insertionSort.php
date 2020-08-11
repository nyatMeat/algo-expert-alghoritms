<?php
function insertionSort(array $array): array
{
	$cnt = count($array);
	for ($i = 1; $i < $cnt; $i++)
	{
		$j = $i;
		while ($j > 0 && $array[$j] < $array[$j - 1])
		{
			$temp = $array[$j];
			$array[$j] = $array[$j - 1];
			$array[$j - 1] = $temp;
			$j++;
		}
	}
	return $array;
}
