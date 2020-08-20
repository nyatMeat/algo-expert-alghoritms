<?php

class Node
{
	public $name;
	/** @var Node */
	public $children = [];

	/**
	 * Node constructor.
	 * @param $name
	 */
	public function __construct($name)
	{
		$this->name = $name;
	}


	public function addChildren($name)
	{
		$this->children[] = new Node($name);
	}
}

/**
 * Обход дерева в глубину
 * время O(v+e)
 * Память O(v)
 */
function depthFirstSearchNonBinaryTree(?Node $node, array &$array = [])
{
	$array[] = $node->name;
	foreach ($node->children as $child)
	{
		depthFirstSearchNonBinaryTree($child, $array);
	};
	return $array;
}
