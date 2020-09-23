<?php
function sumOfFour(array $array, int $targetSum): array
{
	$result = [];
	$cnt = count($array);
	$pairsHashTable = [];//Будем хранить значения соответствия пар
	for ($i = 1; $i < $cnt - 1; $i++)//Начинаем итерировать с первого элемента
	{
		//Итерируем с первого элемента после начального
		for ($j = $i + 1; $j < $cnt; $j++)
		{
			$currentSum = $array[$i] + $array[$j]; //Сумма текущих элементов
			$difference = $targetSum - $currentSum; //Берем разницу значений
			if (isset($pairsHashTable[$difference])) //Если у нас есть уже пары в хеш таблице, то значит текущая пара элементов дает сумму с другой парой, и она равна нужной сумме
			{
				foreach ($pairsHashTable[$difference] as $pair) //Перебираем все пары элементов для этой разницы элементов
				{
					$result[] = array_merge($pair, [$array[$i], $array[$j]]);//Соединяем 2 пары элементов
				}
			}
		}
		//Итерируем элементы с начала, и добавляем их в массив пар
		for ($k = 0; $k < $i; $k++)
		{
			$currentSum = $array[$i] + $array[$k]; //Считаем сумму текущих элементов
			if (!isset($pairsHashTable[$currentSum])) //Если еще нет пары с такой суммой в хеш таблице, то инициализируем эту пару
			{
				$pairsHashTable[$currentSum] = [[$array[$k], $array[$i]]];
			}
			else
			{
				$pairsHashTable[$currentSum][] = [$array[$k], $array[$i]]; //Если уже есть пара, то добавляем в массив
			}
		}
	}
	return $result;
}
