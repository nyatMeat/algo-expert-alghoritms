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
 * Инвертирование бинарного дерева, инвертировать, сделать дерево зеркальным изначальному
 * @param BinaryTree|null $binaryTree
 */
function invertBinaryTree(?BinaryTree $binaryTree)
{
	//Если мы спустились листа, которого нет, то останавливаем выполнение функции
	if (!$binaryTree)
	{
		return;
	}
	$temp = $binaryTree->right; //Запоминаем ссылку на правое дерево в промежуточную переменную
	$binaryTree->right = $binaryTree->left; //Правый указатель меняем на левое дерево
	$binaryTree->left = $temp; //Левый меняем из ссылки, которая ссылалась на правое дерево

	invertBinaryTree($binaryTree->left); //Рекурсивно вызываем для левого листа
	invertBinaryTree($binaryTree->right);  //Рекурсивно вызываем для правого листа
}
