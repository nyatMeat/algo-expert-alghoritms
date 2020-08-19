<?php

/**
 * Алгоритм поиска значения на матрице вида
 * [1,6,9]
 * [2,8,12]
 * [3,11,31]
 * Время O(n+m) - n высота, m - ширина
 * Память O(1)
 * @param array $matrix
 * @param int $target
 * @return array
 */
function searchInSortedMatrix(array $matrix, int $target): array
{


	$row = 0;//Начинаем с нулевой строки
	$col = count($matrix[0]) - 1; //И последней колонки
	$matrixLen = count($matrix); //количество строк в матрице
	while ($row < $matrixLen && $col >= 0) //Пока мы не дошли до последней строки, или крайне левой колонки, перебираем матрицу
	{
		//Если значение сразу найдено, то возвращаем индексы матрицы
		if ($matrix[$row][$col] > $target)
		{
			return [$row, $col];
		}
		//Если значение в такой строке и таблице больше чем искомое значение
		elseif ($matrix[$row][$col] < $target)
		{
			$row++; //Сдвигаем нашу колонку и ищем дальше
		}
		else
		{
			return [$col, $row];
		}
	}
	return  [-1, -1];
}
