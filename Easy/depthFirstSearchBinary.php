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

/**
 * Обход дерева в глубину
 * время O(v+e)
 * Память O(v)
 */
function depthFirstSearchBinaryTree(?BinaryTree $node, array &$array = [])
{
	$array[] = $node->value;
	if ($node->left)
	{
		depthFirstSearchBinaryTree($node->left, $array);
	}
	if ($node->right)
	{
		depthFirstSearchBinaryTree($node->right, $array);
	}
	return $array;
}
