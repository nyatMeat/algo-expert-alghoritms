<?php

class BinarySearchTree
{
	/** @var int */
	public $value;
	/** @var BinarySearchTree|null */
	public $right;
	/** @var BinarySearchTree|null */
	public $left;
}

function findClosestValueInBST(BinarySearchTree $tree, int $target): int
{
	$findClosestHelper = function (?BinarySearchTree $tree, int $target, int $closest) use (&$findClosestHelper)
	{
		$currentNode = $tree;
		while ($currentNode !== null)
		{
			if (abs($target - $closest) > abs($target - $currentNode->value))
			{

				$closest = $currentNode->value;
			}
			if ($target < $currentNode->value)
			{
				$currentNode = $currentNode->left;
			}
			elseif ($target > $currentNode->value)
			{
				$currentNode = $currentNode->right;
			}
			else
			{
				break;
			}
		}
		return $closest;
	};
	return $findClosestHelper($tree, $target, PHP_INT_MAX);

}

