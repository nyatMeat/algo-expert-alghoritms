<?php
function matrixMultiply(array $matrix1, array $matrix2): array
{
	$result = [];
	for ($rowIndex = 0; $rowIndex < count($matrix1); $rowIndex++)
	{
		for ($columnIndex = 0; $columnIndex < count($matrix2[0]); $columnIndex++)
		{
			if (!isset($result[$rowIndex][$columnIndex]))
			{
				$result[$rowIndex][$columnIndex] = 0;
			}
			for ($i = 0; $i < count($matrix1[$rowIndex]); $i++)
			{
				$rowValue = $matrix1[$rowIndex][$i];
				$columnValue = $matrix2[$i][$columnIndex];
				$result[$rowIndex][$columnIndex] += $rowValue * $columnValue;
			}
		}
	}
	return $result;
}
