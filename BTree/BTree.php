<?php


class BTree
{
	/** @var BTreeNode|null */
	public $root;
	/** @var int */
	public $minimumDegree = 0;

	/**
	 * BTree constructor.
	 * @param int $minimumDegree
	 */
	public function __construct(int $minimumDegree)
	{
		$this->minimumDegree = $minimumDegree;
	}


	public function search(int $k): ?BTreeNode
	{
		if ($this->root === null)
		{
			return null;
		}
		return $this->root->search($k);
	}

	public function traverse(&$array = []): array
	{
		if ($this->root !== null)
		{
			$this->root->traverse($array);
		}
		return $array;
	}

	public function remove(int $k)
	{

		if (!$this->root)
		{
			return;
		}
		// Call the remove function for root
		$this->root->remove($k);
		// If the root node has 0 keys, make its first child as the new root
		//  if it has a child, otherwise set root as NULL
		if ($this->root->numberOfKeys === 0)
		{
			$tmp = $this->root;
			if ($this->root->leaf === true)
			{
				$this->root = null;
			}
			else
			{
				$this->root = $this->root->childPointers[0];
			}
			// Free the old root
			unset($tmp);
		}
	}

	public function insert(int $k)
	{
		if ($this->root === null)
		{
			$this->root = new BTreeNode($this->minimumDegree, true);
			$this->root->keys[0] = $k;
			// Update number of keys in root
			$this->root->numberOfKeys = 1;
		}
		else
		{
			if ($this->root->numberOfKeys == 2 * $this->minimumDegree - 1)
			{
				$s = new BTreeNode($this->minimumDegree, true);
				// Make old root as child of new root
				$s->childPointers[0] = $this->root;

				// Split the old root and move 1 key to the new root
				$s->splitChild(0, $this->root);
				$i = 0;
				// Split the old root and move 1 key to the new root
				if ($s->keys[0] < $k)
				{
					$i++;
				}
				// New root has two children now.  Decide which of the
				// two children is going to have new key
				$s->childPointers[$i]->insertNotFull($k);
				// Change root
				$this->root = $s;
			}
			else
			{
				// If root is not full, call insertNonFull for root
				$this->root->insertNotFull($k);
			}
		}
	}

}
