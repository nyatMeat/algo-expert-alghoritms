<?php
interface NodeInterface
{
	public function getValue();

	public function setValue($value): NodeInterface;

	public function getNext(): ?NodeInterface;

	public function setNext(NodeInterface $node): ?NodeInterface;

	public function getPrev(): ?NodeInterface;

	public function setPrev(NodeInterface $node): ?NodeInterface;
}


class Node implements NodeInterface
{
	/** @var int */
	private $value;
	/** @var Node */
	private $next;
	/** @var Node */
	private $prev;

	/**
	 * Node constructor.
	 * @param int $value
	 */
	public function __construct(int $value)
	{
		$this->value = $value;
	}

	/**
	 * @return int
	 */
	public function getValue(): int
	{
		return $this->value;
	}

	/**
	 * @param int $value
	 * @return Node
	 */
	public function setValue($value): NodeInterface
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * @return Node
	 */
	public function getNext(): ?NodeInterface
	{
		return $this->next;
	}

	/**
	 * @param NodeInterface|null $next
	 * @return Node
	 */
	public function setNext(?NodeInterface $next): NodeInterface
	{
		$this->next = $next;
		return $this;
	}

	/**
	 * @return Node
	 */
	public function getPrev(): ?NodeInterface
	{
		return $this->prev;
	}

	/**
	 * @param NodeInterface|null $prev
	 * @return Node
	 */
	public function setPrev(?NodeInterface $prev): NodeInterface
	{
		$this->prev = $prev;
		return $this;
	}


}

interface DoubleLinkedListInterface
{

	public function setTail(NodeInterface $node);

	public function setHead(NodeInterface $node);

	public function insertBefore(NodeInterface $node, NodeInterface $nodeToInsert);

	public function insertAfter(NodeInterface $node, NodeInterface $nodeToInsert);

	public function removeNodeWithValue($value);

	public function remove(NodeInterface $node);

	public function getNodeWithValue($value): ?NodeInterface;

	public function insertAtPosition($position, NodeInterface $nodeToInsert);

	public function consistNodeWithValue($value): bool;
}

class DoubleLinkedList implements DoubleLinkedListInterface
{
	/** @var Node|null */
	private $head;
	/** @var Node|null */
	private $tail;

	public function setTail(NodeInterface $node)
	{
		if (!$this->tail)
		{
			$this->head = $node;
		}
		$this->insertAfter($this->tail, $node);
	}

	public function setHead(NodeInterface $node)
	{
		if (!$this->head)
		{
			$this->head = $node;
			$this->tail = $node;
		}
		$this->insertBefore($this->head, $node);
	}

	public function insertBefore(NodeInterface $node, NodeInterface $nodeToInsert)
	{
		if ($nodeToInsert === $this->head || $nodeToInsert === $this->tail)
		{
			return;
		}
		$this->remove($nodeToInsert);


		$nodeToInsert->setPrev($node);

		$nodeToInsert->setNext($node);
		if (!$node->getPrev())
		{
			$this->head = $nodeToInsert;
		}
		else
		{
			$node->getPrev()->setNext($nodeToInsert);
		}
		$node->setPrev($nodeToInsert);
	}

	public function insertAfter(NodeInterface $node, NodeInterface $nodeToInsert)
	{
		if ($nodeToInsert === $this->head || $nodeToInsert === $this->tail)
		{
			return;
		}
		$this->remove($nodeToInsert);
		$nodeToInsert->setPrev($node);
		$nodeToInsert->setNext($node);
		if (!$node->getNext())
		{
			$this->tail = $nodeToInsert;
		}
		else
		{
			$node->getNext()->setPrev($nodeToInsert);
		}
		$node->setNext($nodeToInsert);
	}

	public function removeNodeWithValue($value)
	{
		$node = $this->head;
		while ($node)
		{
			$nodeToRemove = $node;
			$node = $node->getNext();
			if ($node->getValue() === $value)
			{
				$this->remove($nodeToRemove);
				break;
			}

		}
	}

	public function remove(NodeInterface $node)
	{
		if ($node === $this->head)
		{
			$this->head = $this->head->getNext();
		}
		if ($node === $this->tail)
		{
			$this->tail = $this->tail->getPrev();
		}
		$this->removeNodeBindings($node);
	}

	private function removeNodeBindings(Node $node)
	{
		if ($node->getPrev())
		{
			$node->getPrev()->getNext()->setNext($node->getNext());
		}
		if ($node->getNext())
		{
			$node->getNext()->getPrev()->setPrev($node->getPrev());
		}
		$node->setPrev(null);
		$node->setNext(null);
	}

	public function insertAtPosition($position, $nodeToInsert)
	{
		if ($position == 1)
		{
			$this->setHead($nodeToInsert);
			return;
		}
		$curPos = 1;
		$node = $this->head;
		while ($node && $curPos != $position)
		{
			$node = $node->getNext();
			$curPos++;
		}
		if ($node)
		{
			$this->insertBefore($node, $nodeToInsert);
		}
		else
		{
			$this->setTail($nodeToInsert);
		}
	}


	public function getNodeWithValue($value): ?NodeInterface
	{
		$node = $this->head;
		while ($node && $node->getValue() !== $value)
		{
			$node = $node->getNext();
		}
		return $node;
	}

	public function consistNodeWithValue($value): bool
	{

		return !is_null($this->getNodeWithValue($value));
	}
}
