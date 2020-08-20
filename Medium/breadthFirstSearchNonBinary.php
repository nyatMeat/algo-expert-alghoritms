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
 * Обход дерева в ширину, не бинарного
 * время O(v+e)
 * Память O(v)
 */
function breadthFirstSearchNonBinaryTree(?Node $node)
{
	$array = [];
	$queue = [$node]; //Инициализируем очередь

	while (count($queue) > 0) //перебираем, пока в очереди есть элементы
	{
		//Вытаскиваем из очереди последний элемент
		$current = array_pop($queue);
		$array[] = $current->name; //Добавляем его значение в массив
		//Проходим по всем дочерним элементам, и добавляем их в очередь
		foreach ($current->children as $child)
		{
			$queue[] = $child;
		}
	}
	return $array;
}


