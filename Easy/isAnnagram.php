<?php
function isAnnagramm(string $str1, string $str2)
{

	if (strlen($str1) !== strlen($str2))
	{
		return false;
	}
	$letters = [];
	$arrStr1 = str_split($str1);

	//Наполняем хеш таблицу количеством символов
	foreach ($arrStr1 as $char)
	{
		if (!isset($letters[$char]))
		{
			$letters[$char] = 0;
		}
		$letters[$char]++;
	}
	unset($arrStr1);
	$arrStr2 = str_split($str2);
	foreach ($arrStr2 as $char)
	{
		//Уменьшаем счетчик перед проверкой, если стало меньше нуля, значит символов недостаточно во второй строке
		if (--$letters[$char] < 0)
		{
			return false;
		}
	}
	return true;
}
