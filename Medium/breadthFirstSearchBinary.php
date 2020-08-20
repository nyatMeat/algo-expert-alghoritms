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
 * Обход дерева в ширину, не бинарного
 * время O(v+e)
 * Память O(v)
 */
function breadthFirstSearchNonBinaryTree(BinaryTree $binaryTree)
{
	$array = [];
	$queue = [$binaryTree]; //Инициализируем очередь

	while (count($queue) > 0) //перебираем, пока в очереди есть элементы
	{
		//Вытаскиваем из очереди последний элемент
		/** @var BinaryTree $current */
		$current = array_pop($queue);
		$array[] = $current->value; //Добавляем его значение в массив
		//Проходим по всем дочерним элементам, и добавляем их в очередь
		if ($current->left)
		{

			$queue[] = $current->left;
		}
		if ($current->right)
		{

			$queue[] = $current->right;
		}
	}
	return $array;
}
