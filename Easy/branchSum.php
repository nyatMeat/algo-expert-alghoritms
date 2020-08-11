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

function getBranchSum(BinaryTree $binaryTree): array
{
	$result = [];
	$sumHelper = function (?BinaryTree $node, int $runningSum, &$list) use (&$sumHelper)
	{
		if (!$node)
		{
			return;
		}
		$newRunningSum = $runningSum + $node->value;
		if (!$node->left || !$node->right)
		{
			$list[] = $newRunningSum;
			return;
		}
		$sumHelper($node->left, $runningSum, $list);
		$sumHelper($node->right, $runningSum, $list);
	};
	$sumHelper($binaryTree, 0, $result);
	return $result;
}
