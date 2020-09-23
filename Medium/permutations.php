<?php

function getPermutations(array $array): array
{
	$temp = $array;
	$permutations = [];
	permutationHelper(0, $temp, $permutations);
	return $permutations;
}

function permutationHelper($i, &$array, &$permutations)
{
	if ($i == count($array) - 1) //Если мы дошли до конца, то просто добавляем массив в колекцию permutation
	{
		$permutations[] = $array;
	}
	else
	{
		//Иначе, итерируем от i, до конца массива
		for ($j = $i; $j < count($array); $j++)
		{
			//Меняем элементы в массиве
			$temp = $array[$i];
			$array[$i] = $array[$j];
			$array[$j] = $temp;
			permutationHelper($i + 1, $array, $permutations);
			$temp = $array[$i];
			$array[$i] = $array[$j];
			$array[$j] = $temp;
		}
	}
}
