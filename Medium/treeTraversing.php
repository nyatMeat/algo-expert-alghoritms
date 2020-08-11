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
 * O(n) - time
 * O(n) - space
 * @param BinaryTree|null $node
 * @param array $array
 * @return array
 */
function traverseBstInOrder(?BinaryTree $node, array &$array)
{
	if ($node != null)
	{
		traverseBstInOrder($node->left, $array);
		$array[] = $node->value;
		traverseBstInOrder($node->right, $array);
	}
	return $array;
}

/**
 * O(n) - time
 * O(n) - space
 * @param BinaryTree|null $node
 * @param array $array
 * @return array
 */
function traverseBstPreOrder(?BinaryTree $node, array &$array)
{
	if ($node != null)
	{
		$array[] = $node->value;
		traverseBstPreOrder($node->left, $array);
		traverseBstPreOrder($node->right, $array);
	}
	return $array;
}

/**
 * O(n) - time
 * O(n) - space
 * @param BinaryTree|null $node
 * @param array $array
 * @return array
 */
function traverseBstPostOrder(?BinaryTree $node, array &$array)
{
	if ($node != null)
	{
		traverseBstPostOrder($node->left, $array);
		traverseBstPostOrder($node->right, $array);
		$array[] = $node->value;
	}
	return $array;
}
