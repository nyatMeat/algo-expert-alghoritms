<?php


class BST
{

	/** @var mixed */
	public $value;
	/** @var BST|null */
	public $left = null;
	/** @var BST|null */
	public $right = null;

	public function __construct($value)
	{
		$this->value = $value;
		$this->right = null;
		$this->left = null;
	}

	public function insert($value)
	{
		$currentNode = $this;
		while (true)
		{
			if ($currentNode->value > $value)
			{
				if ($currentNode->left === null)
				{
					$currentNode->left = new static($value);
					break;
				}
				else
				{
					$currentNode = $currentNode->left;
				}
			}
			else
			{
				if ($currentNode->right === null)
				{
					$currentNode->right = new static($value);
					break;
				}
				else
				{
					$currentNode = $currentNode->right;
				}
			}
		}
		return $this;
	}

	public function contains($value)
	{
		$currentNode = $this;
		while ($currentNode !== null)
		{
			if ($currentNode->value > $value)
			{
				$currentNode = $currentNode->left;
			}
			elseif ($currentNode->value < $value)
			{
				$currentNode = $currentNode->right;
			}
			else
			{
				return true;
			}
		}
		return false;
	}

	public function remove($value, $parentNode = null)
	{
		$currentNode = $this;
		while ($currentNode !== null)
		{
			if ($currentNode->value > $value)
			{
				$parentNode = $currentNode;
				$currentNode = $currentNode->left;
			}
			elseif ($currentNode->value < $value)
			{
				$parentNode = $currentNode;
				$currentNode = $currentNode->right;
			}
			else
			{
				if ($currentNode->left && $currentNode->right)
				{
					$currentNode->value = $this->right->getMinValue();
					$currentNode->right->remove($currentNode->value, $parentNode);
				}
				elseif ($parentNode === null)
				{
					if ($currentNode->left !== null)
					{
						$currentNode->value = $currentNode->left->value;
						$currentNode->left = $currentNode->left->left;
						$currentNode->right = $currentNode->left->right;
					}
					elseif ($currentNode->right != null)
					{
						$currentNode->value = $currentNode->right->value;
						$currentNode->left = $currentNode->right->left;
						$currentNode->right = $currentNode->right->right;
					}
					else
					{
						//nothing
					}
				}
				elseif ($parentNode->left === $currentNode)
				{
					$parentNode->left = $currentNode->left !== null ? $currentNode->left : $currentNode->right;
				}
				elseif ($parentNode->right === $currentNode)
				{
					$parentNode->left = $currentNode->left !== null ? $currentNode->left : $currentNode->right;
				}
				break;
			}
		}
		return $this;
	}

	protected function getMinValue()
	{
		$currentNode = $this;
		while ($currentNode !== null)
		{
			$currentNode = $currentNode->left;
		}
		return $currentNode->value;
	}


}



