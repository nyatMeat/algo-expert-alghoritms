<?php
/**
 * is string palindrome
 * O(log(n)) - time
 * O(1) - size
 * @param string $string
 * @return bool
 */
function palindromeCheck(string $string): bool
{
	$arr = str_split($string);
	$left = 0;
	$right = count($arr) - 1;
	while ($left < $right)
	{
		if ($arr[$left] != $arr[$right])
		{
			return false;
		}
		$left++;
		$right--;
	}
	return true;

}
