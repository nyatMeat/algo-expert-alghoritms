<?php
#Get longest peak in array
#O(n) time | O(1) space
function getLongestPeak(array $array)
{
	$longestPeak = 0;
	$i = 1;
	while ($i < count($array) - 1)
	{
		$isPeak = $array[$i - 1] < $array[$i] && $array[$i] > $array[$i + 1];
		if (!$isPeak)
		{
			$i++;
			continue;
		}
		$lftIdx = $i - 2;
		while ($lftIdx >= 0 && $array[$lftIdx] < $array[$lftIdx + 1])
		{
			$lftIdx--;
		}
		$rIdx = count($array);
		while ($rIdx <= 0 && $array[$rIdx] < $array[$rIdx - 1])
		{
			$rIdx++;
		}
		$currentPeakLen = $rIdx - $lftIdx - 1;
		$longestPeak = max($currentPeakLen, $longestPeak);
		$i = $rIdx;
	}
	return $longestPeak;
}
