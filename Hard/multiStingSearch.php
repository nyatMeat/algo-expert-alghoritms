<?php

class Trie
{
	public $root = [];
	public $endSymbol = '*';

	public function insert(string $string)
	{
		$current = &$this->root;
		$strarr = str_split($string);
		foreach ($strarr as $char)
		{
			if (!isset($current[$char]))
			{
				$current[$char] = [];
			}
			$current = &$current[$char];
		}
		$current[$this->endSymbol] = $string;
	}
}


function multiStringSearch(string $bigString, array $smallStrings)
{
	$trie = new Trie();
	foreach ($smallStrings as $smallString)
	{
		$trie->insert($smallString);
	}
	$containedStrings = [];
	$bigStringArr = str_split($bigString);
	foreach ($bigStringArr as $index => $item)
	{
		findSmallStringIn($bigString, $index, $trie, $containedStrings);
	}
	return array_keys($containedStrings);
}

function findSmallStringIn(string $string, int $startIdx, Trie $trie, array &$containedStrings)
{
	$currentNode = $trie->root;
	$stringArr = str_split($string);
	for ($i = $startIdx; $i < count($stringArr); $i++)
	{
		$currentChar = $stringArr[$i];
		if (!isset($currentNode[$currentChar]))
		{
			break;
		}
		$currentNode = $currentNode[$currentChar];
		if (isset($currentNode[$trie->endSymbol]))
		{
			$containedStrings[$currentNode[$trie->endSymbol]] = true;
		}
	}
}
