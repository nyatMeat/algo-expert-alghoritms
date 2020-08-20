<?php
/**
 * @param array $array
 * @return array
 */
function selectionSort(array $array): array
{
	$currentIdx = 0;
	$cnt = count($array);
	//Перебираем весь массив
	while ($currentIdx < $cnt - 1)
	{
		//Выбираем минимальный индекс
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
