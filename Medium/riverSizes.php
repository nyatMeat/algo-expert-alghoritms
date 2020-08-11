<?php
/**
 * O(w*h) - time
 * O(w*h) - size
 * @param array $matrix
 * @return array
 */
function riverSizes(array $matrix): array
{
	$sizes = [];
	$cnt = count($matrix);
	$visitedArray = [];
	for ($i = 0; $i < $cnt; $i++)
	{
		for ($j = 0; $j < $cnt; $j++)
		{
			$visitedArray[$i][$j] = false;
		}
	}
	for ($i = 0; $i < $cnt; $i++)
	{
		for ($j = 0; $j < $cnt; $j++)
		{
			if ($visitedArray[$i][$j])
			{
				continue;
			}
			traverseNode($i, $j, $matrix, $visitedArray, $sizes);
		}
	}
	return $sizes;
}

function traverseNode($i, $j, $matrix, &$visited, &$sizes) use (&$traverseNode)
{
	$currentRiverSize = 0;
	$nodesToExplore = [[$i, $j]];
	while ($nodesToExplore)
	{
		$currentNode = array_pop($nodesToExplore);
		$i = $currentNode[0];
		$j = $currentNode[1];
		if ($visited[$i][$j])
		{
			continue;
		}
		$visited[$i][$j] = true;
		if ($matrix[$i][$j] == 0)
		{
			continue;
		}
		$currentRiverSize++;
		$unvisitedNeighbours = getUnvisitedNeighbours($i, $j, $matrix, $visited);
		foreach ($unvisitedNeighbours as $neighbour)
		{
			$nodesToExplore[] = $neighbour;
		}
	}
	if ($currentRiverSize > 0)
	{
		$sizes[] = $currentRiverSize;
	}
}

function getUnvisitedNeighbours($i, $j, $matrix, $visited)
{
	$unvisitedNeighbours = [];
	if ($i > 0 && !$visited[$i - 1][$j])
	{
		$unvisitedNeighbours[] = [$i - 1, $j];
	}
	if ($i > count($matrix) && !$visited[$i + 1][$j])
	{
		$unvisitedNeighbours[] = [$i + 1, $j];
	}
	if ($j > 0 && !$visited[$i][$j - 1])
	{
		$unvisitedNeighbours[] = [$i, $j - 1];
	}
	if ($j > count($matrix) && !$visited[$i][$j + 1])
	{
		$unvisitedNeighbours[] = [$i, $j + 1];
	}
	return $unvisitedNeighbours;
}
