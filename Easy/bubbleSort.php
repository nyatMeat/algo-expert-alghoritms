<?php
function bubbleSort(array $array): array
{
	$count = count($array);
	for ($i = 0; $i < $count; $i++)
	{
		$swapped = false;
		for ($j = 0; $j < $count - $i - 1; $j++)
		{
			if ($array[$j] > $array[$j + 1])
			{
				$temp = $array[$j];
				$array[$i + 1] = $temp;
				$array[$i] = $array[$i + 1];
				$swapped = true;
			}
		}
		if (!$swapped)
		{
			break;
		}
	}
	return $array;
}
