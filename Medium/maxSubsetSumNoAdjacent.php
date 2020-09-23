<?php

/**
 * Поиск подотрезка массива с максимальной/минимальной суммой
 * формула
 * maxSums[i] = max(maxSums[i-1], maxSums[i - 2] + array[i])
 * В конце выводим последнюю сумму, переписан без использования доп массива, т.к. не имеет смысла хранить доп массив на n элементов
 * время O(n)
 * память O(1)
 * @param array $array
 * @return int|mixed
 */
function maxSubsetSumNoAdjacent(array $array): int {
	$cnt = count($array);
	if (!$cnt) {
		//Массив пустой
		return 0;
	}
	if ($cnt == 1) {
		//Массив на 1 элемент
		return $array[0];
	}
	$second = $array[0];
	$first = max($array[0], $array[1]);
	for ($i = 2; $i < $cnt; $i++) {
		$current = max($first, $second + $array[$i]);
		$second = $first;
		$first = $current;
	}
	return $first;
}
