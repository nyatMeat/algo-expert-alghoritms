<?php
/**
 * O(n) - time (n - elements in sequence)
 * O(1) - memory
 * @param array $sequence
 * @param array $subSeq
 * @return bool
 */
function validateSubSequence(array $sequence, array $subSeq): bool
{
	$subSequenceCnt = count($subSeq);
	$seqIdx = 0;
	foreach ($sequence as $item)
	{
		if ($seqIdx == $subSequenceCnt)
		{
			break;
		}
		if ($subSeq[$seqIdx] == $item)
		{
			$seqIdx++;
		}
	}
	return $subSequenceCnt == $seqIdx;
}
