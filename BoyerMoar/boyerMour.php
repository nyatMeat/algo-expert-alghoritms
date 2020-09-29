<?php

/**
 * Функция для вычисления таблицы сдвигов плохих символов.
 * Она будет равна длине шаблона для всех символов, которые не встречаются в шаблоне,
 * и порядковому номеру с конца для остальных (кроме последнего, для него тоже берется длина шаблона).
 * Вычисляется прямо по определению за O(m+σ).
 * @param string $substr
 * @return array
 */
function preBmBc(string $substr): array
{
	$length = strlen($substr);
	$strArr = str_split($substr);
	$table = array_fill(0, 100, 0);
	// Заполняем значением по умолчанию, равным длине шаблона
	for ($i = 0; $i < 100; $i++)
	{
		$table[$i] = $length;
	}
	// Вычисление функции по определению
	for ($i = 0; $i < $length - 2; $i++)
	{
		$table[$strArr[$i]] = $length - 1 - $i;
	}
	return $table;
}

/**
 * Функция, проверяющая, что подстрока x[p…m−1] является префиксом шаблона x. Требует O(m−p) времени.
 * @param string $substr
 * @param int $p
 * @return bool
 */
function isPrefix(string $substr, int $p): bool
{
	$length = strlen($substr);
	$j = 0;
	$strArr = str_split($substr);
	for ($i = $p; $i < $length - 1; $i++)
	{
		if ($strArr[$i] != $strArr[$j])
		{
			return false;
		}
		++$j;
	}
	return true;
}

/**
 * Функция, возвращающая для позиции p длину максимальной подстроки, которая является суффиксом шаблона x.
 * Требует O(m−p) времени. //здесь неправильно, нет смысла сравнивать элементы ШАБЛОНА С САМИМ СОБОЙ
 * @param string $substr
 * @param int $p
 * @return int
 */
function suffixLength(string $substr, int $p): int
{
	$length = strlen($substr);
	$strArr = str_split($substr);
	$len = 0;
	$i = $p;
	$j = $length - 1;
	while ($i >= 0 and $strArr[$i] == $strArr[$j])
	{
		++$len;
		--$i;
		--$j;
	}
	return $len;
}

function preBmGs(string $substr): array
{
	$length = strlen($substr);
	$strArr = str_split($substr);
	$table = [];
	$lastPrefixPosition = $length;
	for ($i = $length - 1; $i > 0; $i--)
	{
		// Если подстрока x[i+1..m-1] является префиксом, то запомним её начало
		if (isPrefix($substr, $i + 1))
		{
			$lastPrefixPosition = $i + 1;
		}

		$table[$length - 1 - $i] = $lastPrefixPosition - $i + $length - 1;
	}
	// Вычисление функции по определению
	for ($i = 0; $i < $length - 2; $i++)
	{
		$slen = suffixLength($substr, $i);
		$table[$slen] = $length - 1 - $i + $slen;
	}
	return $table;
}

function BM($string, $substr): array
{
	$substLength = strlen($substr);
	$substrArr = str_split($substr);
	$stringArr = str_split($string);
	$length = strlen($string);
	$answer = []; // вектор, содержащий все вхождения подстроки в строку
	if ($substLength == 0)
	{
		return $answer;
	}

	// Предварительные вычисления
	$bmBc = preBmBc($substr);
	$bmGs = preBmGs($substr);

	// Поиск подстроки
	for ($i = $substLength - 1; $i < $length - 1; $i++)
	{
		$j = $substLength - 1;

		while ($substrArr[$j] == $stringArr[$i])
		{
			if ($j == 0)
			{
				$answer[] = $i;
			}
			--$i;
			--$j;
		}
		$i += max($bmGs[$substLength - 1 - $j], $bmBc[$stringArr[$i]]);
	}
	if (!$answer)
	{
	}
	return $answer;
}
