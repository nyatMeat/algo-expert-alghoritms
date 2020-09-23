<?php


class BTreeNode
{
	/** @var int[] */
	public $keys = [];
	/** @var int */
	public $minimumDegree = 0;
	/** @var BTreeNode[] */
	public $childPointers = [];
	/** @var int */
	public $numberOfKeys = 0;
	/** @var bool */
	public $leaf = false;


	/**
	 * BTreeNode constructor.
	 * @param int $minimumDegree
	 * @param bool $leaf
	 */
	public function __construct(int $minimumDegree, bool $leaf)
	{
		$this->minimumDegree = $minimumDegree;
		$this->leaf = $leaf;
		$this->keys = [];
		$this->childPointers = [];
		$this->numberOfKeys = 0;
	}

	public function traverse(&$array = [])
	{

		for ($i = 0; $i < $this->numberOfKeys; $i++)
		{

			// If this is not leaf, then before printing key[i],
			// traverse the subtree rooted with child C[i].
			if ($this->leaf === false)
			{
				$this->childPointers[$i]->traverse($array);
			}
			$array[] = $this->keys[$i];
		}

		// Print the subtree rooted with last child
		if ($this->leaf == false)
		{
			$this->childPointers[$i]->traverse($array);
		}
	}

	public function search(int $k): ?BTreeNode
	{
		// Find the first key greater than or equal to k
		$i = 0;
		while ($i < $this->numberOfKeys && $k > $this->keys[$i])
			$i++;

		// If the found key is equal to k, return this node
		if ($this->keys[$i] === $k)
			return $this;

		// If the key is not found here and this is a leaf node
		if ($this->leaf == true)
			return null;

		// Go to the appropriate child
		return $this->childPointers[$i]->search($k);
	}


	// A utility function to split the child y of this node
	// Note that y must be full when this function is called
	public function splitChild(int $i, BTreeNode $y)
	{
		$z = new BTreeNode($y->minimumDegree, $y->leaf);
		$z->numberOfKeys = $this->minimumDegree - 1;
		for ($j = 0; $j < $this->minimumDegree - 1; $j++)
		{
			$z->keys[$j] = $y->keys[$j + $this->minimumDegree];
		}
		if ($y->leaf === false)
		{
			for ($j = 0; $j < $this->minimumDegree; $j++)
			{
				$z->childPointers[$j] = $y->childPointers[$j + $this->minimumDegree];
			}
		}
		// Reduce the number of keys in y
		$y->numberOfKeys = $this->minimumDegree - 1;


		// Since this node is going to have a new child,
		// create space of new child
		for ($j = $this->numberOfKeys; $j >= $i + 1; $j--)
		{
			$this->childPointers[$j + 1] = $this->childPointers[$j];
		}

		// Link the new child to this node
		$this->childPointers[$i + 1] = $z;

		// A key of y will move to this node. Find the location of
		// new key and move all greater keys one space ahead
		for ($j = $this->numberOfKeys - 1; $j >= $i; $j--)
		{
			$this->keys[$j + 1] = $this->keys[$j];
		}

		// Copy the middle key of y to this node
		$this->keys[$i] = $y->keys[$this->minimumDegree - 1];

		// Increment count of keys in this node
		$this->numberOfKeys = $this->numberOfKeys + 1;
	}

	// A utility function to insert a new key in this node
	// The assumption is, the node must be non-full when this
	// function is called
	public function insertNotFull(int $k)
	{
		$i = $this->numberOfKeys - 1;
		if ($this->leaf === true)
		{
			// The following loop does two things
			// a) Finds the location of new key to be inserted
			// b) Moves all greater keys to one place ahead
			while ($i >= 0 && $this->keys[$i] > $k)
			{
				$this->keys[$i + 1] = $this->keys[$i];
				$i--;
			}

			// Insert the new key at found location
			$this->keys[$i + 1] = $k;
			$this->numberOfKeys = $this->numberOfKeys + 1;
		}
		else
		{
			// Find the child which is going to have the new key
			while ($i >= 0 && $this->keys[$i] > $k)
				$i--;

			// See if the found child is full
			if ($this->childPointers[$i + 1]->numberOfKeys == 2 * $this->minimumDegree - 1)
			{
				// If the child is full, then split it
				$this->splitChild($i + 1, $this->childPointers[$i + 1]);

				// After split, the middle key of C[i] goes up and
				// C[i] is splitted into two.  See which of the two
				// is going to have the new key
				if ($this->keys[$i + 1] < $k)
				{
					$i++;
				}
			}
			$this->childPointers[$i + 1]->insertNonFull($k);
		}

	}

	// A function that returns the index of the first key that is greater
	// or equal to k
	public function findKey(int $k)
	{
		$idx = 0;
		while ($idx < $this->numberOfKeys && $this->keys[$idx] < $k)
		{
			++$idx;
		}
		return $idx;
	}

	// A wrapper function to remove the key k in subtree rooted with
	// this node.
	public function remove(int $k)
	{
		$idx = $this->findKey($k);
		if ($idx < $this->numberOfKeys && $this->keys[$idx] == $k)
		{
			if ($this->leaf)
			{
				$this->removeFromLeaf($idx);
			}
			else
			{
				$this->removeFromNonLeaf($idx);
			}
		}
		else
		{
			if ($this->leaf === true)
			{
				return;
			}
			$flag = $idx === $this->numberOfKeys;
			if ($this->childPointers[$idx]->numberOfKeys < $this->minimumDegree)
			{
				$this->fill($idx);
			}
			if ($flag && $idx > $this->numberOfKeys)
			{
				$this->childPointers[$idx - 1]->remove($k);
			}
			else
			{
				$this->childPointers[$idx]->remove($k);
			}
		}

	}
	// A function to remove the key present in idx-th position in
	// this node which is a leaf
	public function removeFromLeaf(int $idx)
	{
		// Move all the keys after the idx-th pos one place backward
		for ($i = $idx + 1; $i < $this->numberOfKeys; ++$i)
		{
			$this->keys[$i - 1] = $this->keys[$i];
		}

		// Reduce the count of keys
		$this->numberOfKeys--;
	}

	// A function to remove the key present in idx-th position in
	// this node which is a non-leaf node
	public function removeFromNonLeaf(int $idx)
	{

		$k = $this->keys[$idx];

		// If the child that precedes k (C[idx]) has atleast t keys,
		// find the predecessor 'pred' of k in the subtree rooted at
		// C[idx]. Replace k by pred. Recursively delete pred
		// in C[idx]
		if ($this->childPointers[$idx]->numberOfKeys >= $this->minimumDegree)
		{
			$pred = $this->getPred($idx);
			$this->keys[$idx] = $pred;
			$this->childPointers[$idx]->remove($pred);
		}

		// If the child C[idx] has less that t keys, examine C[idx+1].
		// If C[idx+1] has atleast t keys, find the successor 'succ' of k in
		// the subtree rooted at C[idx+1]
		// Replace k by succ
		// Recursively delete succ in C[idx+1]
		else if ($this->childPointers[$idx + 1]->numberOfKeys >= $this->minimumDegree)
		{
			$succ = $this->getSucc($idx);
			$this->keys[$idx] = $succ;
			$this->childPointers[$idx + 1]->remove($succ);
		}

		// If both C[idx] and C[idx+1] has less that t keys,merge k and all of C[idx+1]
		// into C[idx]
		// Now C[idx] contains 2t-1 keys
		// Free C[idx+1] and recursively delete k from C[idx]
		else
		{

			$this->merge($idx);
			$this->childPointers[$idx]->remove($k);
		}


	}
	// A function to remove the key present in idx-th position in
	// this node which is a non-leaf node
	public function getPred(int $idx)
	{
		$cur = $this->childPointers[$idx];
		while (!$cur->leaf)
		{
			$cur = $cur->childPointers[$cur->numberOfKeys];
		}

		// Return the last key of the leaf
		return $cur->keys[$cur->numberOfKeys - 1];
	}
	// A function to get the successor of the key- where the key
	// is present in the idx-th position in the node
	public function getSucc(int $idx)
	{
		// Keep moving the left most node starting from C[idx+1] until we reach a leaf
		$cur = $this->childPointers[$idx + 1];
		while (!$cur->leaf)
		{
			$cur = $cur->childPointers[0];
		}

		// Return the first key of the leaf
		return $cur->keys[0];
	}

// A function to fill child C[idx] which has less than t-1 keys
	public function fill(int $idx)
	{
		// If the previous child(C[idx-1]) has more than t-1 keys, borrow a key
		// from that child
		if ($idx != 0 && $this->childPointers[$idx - 1]->numberOfKeys >= $this->minimumDegree)
		{
			$this->borrowFromPrev($idx);
		}

		// If the next child(C[idx+1]) has more than t-1 keys, borrow a key
		// from that child
		else if ($idx != $this->numberOfKeys && $this->childPointers[$idx + 1]->numberOfKeys >= $this->minimumDegree)
			$this->borrowFromNext($idx);

		// Merge C[idx] with its sibling
		// If C[idx] is the last child, merge it with with its previous sibling
		// Otherwise merge it with its next sibling
		else
		{
			if ($idx != !$this->numberOfKeys)
			{
				$this->merge($idx);
			}
			else
			{
				$this->merge($idx - 1);
			}
		}
	}

	//A function to borrow a key from the C[idx-1]-th node and place
	// it in C[idx]th node
	public function borrowFromPrev(int $idx)
	{
		$child = $this->childPointers[$idx];
		$sibling = $this->childPointers[$idx - 1];

		// The last key from C[idx-1] goes up to the parent and key[idx-1]
		// from parent is inserted as the first key in C[idx]. Thus, the  loses
		// sibling one key and child gains one key

		// Moving all key in C[idx] one step ahead
		for ($i = $child->numberOfKeys - 1; $i >= 0; --$i)
		{
			$child->keys[$i + 1] = $child->keys[$i];
		}

		// If C[idx] is not a leaf, move all its child pointers one step ahead
		if (!$child->leaf)
		{
			for ($i = $child->numberOfKeys; $i >= 0; --$i)
			{
				$child->childPointers[$i + 1] = $this->childPointers[$i];
			}
		}

		// Setting child's first key equal to keys[idx-1] from the current node
		$child->keys[0] = $this->keys[$idx - 1];

		// Moving sibling's last child as C[idx]'s first child
		if (!$child->leaf)
		{
			$child->childPointers[0] = $sibling->childPointers[$sibling->numberOfKeys];
		}

		// Moving the key from the sibling to the parent
		// This reduces the number of keys in the sibling
		$this->keys[$idx - 1] = $sibling->keys[$sibling->numberOfKeys - 1];

		$child->numberOfKeys += 1;
		$sibling->numberOfKeys -= 1;
	}

	// A function to borrow a key from the C[idx+1] and place
	// it in C[idx]
	public function borrowFromNext(int $idx)
	{
		$child = $this->childPointers[$idx];
		$sibling = $this->childPointers[$idx + 1];

		// keys[idx] is inserted as the last key in C[idx]
		$child->keys[$child->numberOfKeys] = $this->keys[$idx];

		// Sibling's first child is inserted as the last child
		// into C[idx]
		if (!$child->leaf)
		{
			$child->childPointers[$child->numberOfKeys + 1] = $sibling->childPointers[0];
		}

		//The first key from sibling is inserted into keys[idx]
		$this->keys[$idx] = $sibling->keys[0];

		// Moving all keys in sibling one step behind
		for ($i = 1; $i < $sibling->numberOfKeys; ++$i)
		{
			$sibling->keys[$i - 1] = $sibling->keys[$i];
		}

		// Moving the child pointers one step behind
		if (!$sibling->leaf)
		{
			for ($i = 1; $i <= $sibling->numberOfKeys; ++$i)
			{
				$sibling->childPointers[$i - 1] = $sibling->childPointers[$i];
			}
		}

		// Increasing and decreasing the key count of C[idx] and C[idx+1]
		// respectively
		$child->numberOfKeys += 1;
		$sibling->numberOfKeys -= 1;
	}

	// A function to merge idx-th child of the node with (idx+1)th child of
	// the node
	public function merge(int $idx)
	{
		$child = $this->childPointers[$idx];
		$sibling = $this->childPointers[$idx + 1];

		// Pulling a key from the current node and inserting it into (t-1)th
		// position of C[idx]
		$child->keys[$this->minimumDegree - 1] = $this->keys[$idx];

		// Copying the keys from C[idx+1] to C[idx] at the end
		for ($i = 0; $i < $sibling->numberOfKeys; ++$i)
		{
			$child->keys[$i + $this->minimumDegree] = $sibling->keys[$i];
		}

		// Copying the child pointers from C[idx+1] to C[idx]
		if (!$child->leaf)
		{
			for ($i = 0; $i <= $sibling->numberOfKeys; ++$i)
			{
				$child->childPointers[$i + $this->minimumDegree] = $sibling->childPointers[$i];
			}
		}

		// Moving all keys after idx in the current node one step before -
		// to fill the gap created by moving keys[idx] to C[idx]
		for ($i = $idx + 1; $i < $this->numberOfKeys; ++$i)
		{
			$keys[$i - 1] = $this->keys[$i];
		}

		// Moving the child pointers after (idx+1) in the current node one
		// step before
		for ($i = $idx + 2; $i <= $this->numberOfKeys; ++$i)
		{
			$this->childPointers[$i - 1] = $this->childPointers[$i];
		}

		// Updating the key count of child and the current node
		$child->numberOfKeys += $sibling->n + 1;
		$this->numberOfKeys--;

		// Freeing the memory occupied by sibling
		unset($sibling);
	}

}
