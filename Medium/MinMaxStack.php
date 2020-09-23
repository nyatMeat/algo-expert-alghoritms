<?php


class MinMaxStack
{
	protected $stack = [];
	protected $minMaxStack = [];

	public function peek()
	{
		return $this->stack[count($this->stack) - 1];
	}

	public function pop()
	{
		array_pop($this->minMaxStack);
		return array_pop($this->stack);
	}

	public function push($value)
	{
		$newMinMax = ['min' => $value, 'max' => $value];

		if ($this->minMaxStack)
		{
			$lastMinMax = $this->minMaxStack[count($this->minMaxStack) - 1];
			$newMinMax['max'] = max($lastMinMax['max'], $value);
			$newMinMax['min'] = min($lastMinMax['min'], $value);
		}
		$this->minMaxStack[] = $newMinMax;
		$this->stack[] = $value;
	}

	public function getMax()
	{
		return $this->minMaxStack[count($this->minMaxStack) - 1]['max'];
	}

	public function getMin()
	{
		return $this->minMaxStack[count($this->minMaxStack) - 1]['min'];
	}
}
