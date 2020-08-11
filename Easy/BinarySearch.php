<?php


class BinarySearch
{
	const BS_DEFAULT = 0;
	const BS_FIRST = 1;
	const BS_LAST = 2;

	/**
	 * Бинарный поиск
	 * @param array $a
	 * @param $needValue
	 * @param int $flag 0 - если нужно найти индекс элемента вне зависимости от положения, 1 - если первый элемент, 2 - если последний элемент
	 * @return int
	 */
	public static function search(array $a, $needValue, $flag = self::BS_DEFAULT): int
	{

		if ($needValue > $a[count($a) - 1] || $needValue < $a[0])
		{
			return -1;
		}

		switch ($flag)
		{
			case self::BS_DEFAULT:
				$l = 0;
				$r = count($a) - 1;
				while ($r >= $l)
				{
					$m = ($l + $r) >> 1;
					if ($a[$m] === $needValue)
					{
						return $m;
					}
					elseif ($a[$m] > $needValue)
					{
						$r = $m - 1;
					}
					else
					{
						$l = $m + 1;
					}
				}
				return -1;
			case self::BS_FIRST:
				$l = -1;
				$r = count($a);
				while ($r > $l + 1)
				{
					$m = ($l + $r) >> 1;
					if ($a[$m] < $needValue)
					{
						$l = $m;
					}
					else
					{
						$r = $m;
					}
				}
				if ($r < count($a) && $a[$r] === $needValue)
				{
					return $r;
				}
				else
				{
					return -1;
				}
			case self::BS_LAST:
				$l = -1;
				$r = count($a);
				while ($r > $l + 1)
				{
					$m = ($l + $r) >> 1;
					if ($a[$m] < $needValue)
					{
						$l = $m;
					}
					else
					{
						$r = $m;
					}
				}
				if ($l >= 0 && $a[$l] === $needValue)
				{
					return $l;
				}
				else
				{
					return -1;
				}
			default:
				return -1;
		}
	}

	public static function binarySearchCallback(array $a, $needValue, callable $selectFunction, $flag = self::BS_DEFAULT): int
	{

		if ($needValue > $a[count($a) - 1] || $needValue < $a[0])
		{
			return -1;
		}

		switch ($flag)
		{
			case self::BS_DEFAULT:
				$l = 0;
				$r = count($a) - 1;
				while ($r >= $l)
				{
					$m = ($l + $r) >> 1;
					if ($selectFunction($a[$m]) === $needValue)
					{
						return $m;
					}
					elseif ($selectFunction($a[$m]) > $needValue)
					{
						$r = $m - 1;
					}
					else
					{
						$l = $m + 1;
					}
				}
				return -1;
			case self::BS_FIRST:
				$l = -1;
				$r = count($a);
				while ($r > $l + 1)
				{
					$m = ($l + $r) >> 1;
					if ($selectFunction($a[$m]) < $needValue)
					{
						$l = $m;
					}
					else
					{
						$r = $m;
					}
				}
				if ($r < count($a) && $selectFunction($a[$r]) === $needValue)
				{
					return $r;
				}
				else
				{
					return -1;
				}
			case self::BS_LAST:
				$l = -1;
				$r = count($a);
				while ($r > $l + 1)
				{
					$m = ($l + $r) >> 1;
					if ($selectFunction($a[$m]) < $needValue)
					{
						$l = $m;
					}
					else
					{
						$r = $m;
					}
				}
				if ($l >= 0 && $selectFunction($a[$l]) === $needValue)
				{
					return $l;
				}
				else
				{
					return -1;
				}
			default:
				return -1;
		}
	}

}
