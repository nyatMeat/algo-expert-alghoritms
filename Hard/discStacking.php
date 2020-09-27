<?php
function discStacking(array $discs)
{
	$heights = [];
	$sequences = [];
	$maxHeightIdx = 0;
	for ($i = 0; $i < count($discs); $i++)
	{
		$heights[] = $discs[$i][2];
		$sequences[] = null;
	}

	for ($i = 0; $i < count($discs); $i++)
	{
		$currentDisc = $discs[$i];
		for ($j = 0; $j < $i; $j++)
		{
			$otherDisc = $discs[$j];
			if (areValidDimensions($otherDisc, $currentDisc))
			{
				if ($heights[$i] <= $currentDisc[2] + $heights[$j])
				{
					$heights[$i] = $currentDisc[2] + $heights[$j];
					$sequences[$i] = $j;
				}
			}
		}
		if ($heights[$i] >= $heights[$maxHeightIdx])
		{
			$maxHeightIdx = $i;
		}
	}
	return buildSequence($discs, $sequences, $maxHeightIdx);
}

function buildSequence(array $array, $sequences, $currentIdx)
{
	$sequence = [];
	while ($currentIdx !== null)
	{
		$sequence[] = $array[$currentIdx];
		$currentIdx = $sequences[$currentIdx];
	}
	return array_reverse($sequence);
}

function areValidDimensions(array $otherDisc, array $currentDisc)
{
	return $otherDisc[0] < $currentDisc[0] && $otherDisc[1] < $currentDisc[1] && $otherDisc[2] < $currentDisc[2];
}
