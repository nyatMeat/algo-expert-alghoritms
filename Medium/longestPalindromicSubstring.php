<?php

/**
 * Время O(n^2)
 * Память O(1)
 * строка вида abaxyzzyxb - самый длинный палиндром xyzzyx
 * Поиск самого длинного палиндрома в строке
 * @param string $string
 * @return string
 */
function longestPalindromicSubstring(string $string): string
{
	//Идея, двигаемся по строке, и для каждой позиции ищем палиндром, отдельно для четной буквы и нечетной
	$arr = str_split($string);
	$currentLongest = [0, 1];//Сначала предполагаем, что первый символ у нас является палиндромом сам по себе
	for ($i = 1; $i < count($arr); $i++)//Начинаем перебор с единицы, т.к. мы уже имеем палиндром в начале
	{
		//Получаем индексы под-палиндрома для нечетной буквы
		$odd = getLongestPalindromeFrom($arr, $i - 1, $i + 1);
		//Получаем  индексы под-палиндрома для четной буквы
		$even = getLongestPalindromeFrom($arr, $i - 1, $i);
		$longest = $odd[1] - $odd[0] > $even[1] - $even[0] ? $odd : $even; //Сравниваем длину палиндрома для четной и нечетной буквы, и лучший результат записываем
		$currentLongest = $currentLongest[1] - $currentLongest[0] > $longest[1] - $longest[0] ? $currentLongest : $longest; //Если предыущая длина, меншье новой посчитанной, то переприсваеваем
	}
	return substr($string, $currentLongest[0], $currentLongest[1] - $currentLongest[0]);
}

/**
 * Ищем палиндром в строке для конкретной позиции, возвращает индексы палиндрома в строке
 * @param array $arr
 * @param $leftIdx
 * @param $rightIdx
 * @return array
 */
function getLongestPalindromeFrom(array $arr, $leftIdx, $rightIdx)
{
	//Пока мы не вышли за границы строки, то перебираем символы
	while ($leftIdx >= 0 && $rightIdx < count($arr))
	{
		//Если символ по левую сторону, не равен символу с правой стороны, то палиндром у нас закончился
		if ($arr[$leftIdx] != $arr[$rightIdx])
		{
			break;
		}
		//Иначе, сдвигаем индексы
		$leftIdx--;
		$rightIdx++;
	}
	//Возвращаем индесы нашего палиндрома. К левому + 1, т.к. мы начали подсчет с единицы
	return [$leftIdx + 1, $rightIdx];
}
