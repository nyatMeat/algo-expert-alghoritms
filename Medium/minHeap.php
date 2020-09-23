<?php

class MinHeap
{
	/** @var array */
	public $heap;

	/**
	 * MinHeap constructor.
	 * @param array $array
	 */
	public function __construct(array $array)
	{
		$this->heap = $this->buildHeap($array);
	}

	protected function buildHeap(array $array)
	{
		$temp = $array;
		$firstParentIdx = (count($array) - 2) >> 1;
		for ($currentIdx = $firstParentIdx; $currentIdx >= 0; $currentIdx--)
		{
			$this->shiftDown($currentIdx, count($temp) - 1, $temp);
		}
		return $temp;
	}

	public function insert($value)
	{
		$this->heap[] = $value;
		$this->shiftUp(count($this->heap) - 1, $this->heap);
	}

	protected function shiftUp($currentIdx, &$heap)
	{
		$parentIdx = ($currentIdx - 1) >> 1;
		while ($currentIdx < 0 && $heap[$currentIdx] < $heap[$parentIdx])
		{
			$this->swap($currentIdx, $parentIdx, $heap);
			$currentIdx = $parentIdx;
			$parentIdx = ($currentIdx - 1) >> 1;
		}
	}

	public function shiftDown($currentIdx, $endIdx, &$heap)
	{
		$childOneIdx = $currentIdx << 1 + 1;
		while ($childOneIdx <= $endIdx)
		{
			$childTwoIdx = $currentIdx << 1 + 2 <= $endIdx ? $currentIdx << 1 + 2 : -1;
			if ($childTwoIdx !== -1 && $heap[$childTwoIdx] < $heap[$childOneIdx])
			{
				$idxToSwap = $childTwoIdx;
			}
			else
			{
				$idxToSwap = $childOneIdx;
			}
			if ($heap[$idxToSwap] < $heap[$currentIdx])
			{
				$this->swap($currentIdx, $idxToSwap, $heap);
				$currentIdx = $idxToSwap;
				$childOneIdx = $currentIdx << 1 + 1;
			}
			else
			{
				return;
			}
		}
	}

	public function peek()
	{
		return $this->heap[0];
	}

	public function remove()
	{
		$this->swap(0, count($this->heap) - 1, $this->heap);
		$valueToRemove = array_pop($this->heap);
		$this->shiftDown(0, count($this->heap) - 1, $this->heap);
		return $valueToRemove;
	}


	private function swap($i, $j, &$heap)
	{
		$temp = $heap[$i];
		$heap[$i] = $heap[$j];
		$heap[$j] = $temp;
	}

}


