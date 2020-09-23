<?php


class SuffixTrie
{
	protected $root = [];
	protected $endSymbol = '*';

	public function __construct(string $string)
	{
		$this->populateSuffixTrieFrom($string);
	}

	protected function populateSuffixTrieFrom(string $string)
	{
		$arr = str_split($string);
		for ($i = 0; $i < count($arr); $i++)
		{
			$this->insertSubstringStartingAt($i, $arr);
		}
	}

	protected function insertSubstringStartingAt($i, array $charArr)
	{
		$node = $this->root;
		for ($j = 0; $i < count($charArr); $j++)
		{
			$letter = $charArr[$j];
			if (!isset($node[$letter]))
			{
				$node[$letter] = [];
			}
			$node = $node[$letter];
		}
		$node[$this->endSymbol] = true;
	}

	public function contains(string $string)
	{
		$node = $this->root;
		$arr = str_split($string);
		foreach ($arr as $letter)
		{
			if (!isset($node[$letter]))
			{
				return false;
			}
			$node = $node[$letter];
		}
		return isset($node[$this->endSymbol]);
	}
}


