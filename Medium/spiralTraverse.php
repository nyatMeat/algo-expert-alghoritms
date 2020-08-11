<?php
/**
 * O(n) - time
 * O(n) - size
 * @param array $array
 * @return array
 */
function spiralTraverse(array $array): array
{
	$result = [];
	$startRow = 0;
	$startColumn = 0;
	$endColumn = count($array[0]) - 1;
	$endRow = count($array) - 1;
	while ($startRow <= $endRow && $startColumn <= $endColumn)
	{
		for ($col = $startColumn; $col < $endColumn + 1; $col++)
		{
			$result[] = $array[$startRow][$col];
		}
		for ($row = $startRow + 1; $row < $endRow + 1; $row++)
		{
			$result[] = $array[$row][$endColumn];
		}
		for ($col = $endColumn - 1; $col > $startColumn - 1; $col--)
		{
			$result[] = $array[$endRow][$col];
		}
		for ($row = $endRow - 1; $row > $startRow; $row--)
		{
			$result[] = $array[$row][$startColumn];
		}
		$startRow++;
		$startColumn++;
		$endRow--;
		$endColumn--;

	}
	return $result;

}

/**
 * O(n) - time
 * O(n) - size
 * @param array $array
 * @return array
 */
function spiralTraverseRecursive(array $array): array
{
	$result = [];
	$spiralFill = function ($array, $startRow, $startColumn, $endRow, $endColumn, &$result) use (&$spiralFill)
	{
		if ($startRow > $endRow || $startColumn > $endColumn)
		{
			return;
		}
		for ($col = $startColumn; $col < $endColumn + 1; $col++)
		{
			$result[] = $array[$startRow][$col];
		}
		for ($row = $startRow + 1; $row < $endRow + 1; $row++)
		{
			$result[] = $array[$row][$endColumn];
		}
		for ($col = $endColumn - 1; $col > $startColumn - 1; $col--)
		{
			$result[] = $array[$endRow][$col];
		}
		for ($row = $endRow - 1; $row > $startRow; $row--)
		{
			$result[] = $array[$row][$startColumn];
		}
		$spiralFill($array, $startRow + 1, $startColumn + 1, $endRow - 1, $endColumn - 1, $result);
	};
	$spiralFill($array, 0, 0, count($array) - 1, count($array[0]) - 1, $result);
	return $result;
}

