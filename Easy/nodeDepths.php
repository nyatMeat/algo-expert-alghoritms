<?php


class BinaryTree
{
	/** @var int */
	public $value;
	/** @var BinaryTree|null */
	public $right;
	/** @var BinaryTree|null */
	public $left;
}

function nodeDepths(BinaryTree $binaryTree): int
{
	$depthHelper = function (?BinaryTree $node, $depth = 0) use (&$depthHelper)
	{
		if (!$node)
		{
			return 0;
		}
		return $depth + $depthHelper($node->left, $depth + 1) + $depthHelper($node->right, $depth + 1);
	};
	return $depthHelper($binaryTree);
}
