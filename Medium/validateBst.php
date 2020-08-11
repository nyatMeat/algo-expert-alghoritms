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

function validateBst(?BinaryTree $node)
{
	$validateHelper = function (?BinaryTree $node, $minVal, $maxVal) use (&$validateHelper)
	{
		if (!$node)
		{
			return true;
		}
		if ($node->value < $minVal || $node->value >= $maxVal)
		{
			return false;
		}
		$leftIsValid = $validateHelper($node->left, $minVal, $node->value);
		return $leftIsValid && $validateHelper($node->right, $node->value, $maxVal);
	};
	return $validateHelper($node, PHP_INT_MIN, PHP_INT_MAX);
}

