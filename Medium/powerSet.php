<?php

/**
 * Получить все подмножества определенного множества
 * @param array $array
 * @param null $idx
 * @return array
 */
function powerSetRecursive(array $array, $idx = null): array
{
	if (!$idx)
	{
		$idx = count($array) - 1;
	}
	elseif ($idx < 0)
	{
		return [[]];
	}
	$element = $array[$idx];
	$subsets = powerSetRecursive($array, $idx - 1);
	$cnt = count($subsets);
	for ($i = 0; $i < $cnt; $i++)
	{
		$currentSubset = $subsets[$i];
		$currentSubset[] = $element;
		$subsets[] = $currentSubset;
	}
	unset($subsets[0]);
	return $subsets;
}

function powerSetIterative(array $array): array
{
	$subsets = [[]]; //Инициализируем нулевое подмножество
	//перебираем все элементы массива
	foreach ($array as $element)
	{
		//Перебираем все подмножества, которые сформировали, на 1 шаге у нас пустое подмножество
		$cnt = count($subsets);
		for ($i = 0; $i < $cnt; $i++)
		{
			//Берем текущее подмножество, на нулевом шаге, просто добавляем элемент в подмножество
			$currentSubset = $subsets[$i];
			$currentSubset[] = $element;
			$subsets[] = $currentSubset; //Запоминаем это подмножество
		}
	}
	//Удаляем нулевое подмножество
	unset($subsets[0]);
	return $subsets;
}
