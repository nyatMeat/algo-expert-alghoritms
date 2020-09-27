<?php


class AhoCorasick
{
	const MAXS = 1000;
	const MAXC = 93; //Count symbols in the alpabet
	const MAXV = 500;

	/** @var string[] */
	protected $arr = [];
	protected $text;
	protected $g;
	protected $f;
	protected $out;

	public function initialize(array $arr, string $text)
	{
		$this->arr = $arr;
		$this->text = $text;
		for ($i = 0; $i < self::MAXS; $i++)
		{
			$this->g[$i] = array_fill(0, self::MAXC, -1);
		}
		$this->f = array_fill(0, self::MAXS, 0);
		return $this;
	}

	function buildMachine()
	{

		$state = $currState = $index = 0;
		for ($i = 0; $i < count($this->arr); $i++)
		{
			$str = $this->arr[$i];
			$strArr = str_split($str);
			$currState = 0;
			for ($j = 0; $j < count($strArr); $j++)
			{

				$index = ord($strArr[$j]) - 33;
				if ($this->g[$currState][$index] === -1)
				{
					$this->g[$currState][$index] = ++$state;
				}
				$currState = $this->g[$currState][$index];
			}
			$this->out[$currState] = $i;
		}
		$queue = [];
		for ($i = 0; $i < self::MAXC; $i++)
		{
			if ($this->g[0] !== -1)
			{
				$this->f[$this->g[0][$i]] = 0;
				$queue[] = $this->g[0][$i];
			}
			else
			{
				$this->g[0][$i] = 0;
			}
		}
		while (!empty($queue))
		{
			$s = $queue[array_key_first($queue)];
			array_pop($queue);
			for ($i = 0; $i < self::MAXC; $i++)
			{
				if ($this->g[$s][$i] !== -1)
				{
					$queue[] = $this->g[$s][$i];
					$fail = $this->f[$s];
					while ($this->g[$fail][$i] !== -1)
					{
						$fail = $this->f[$fail];
					}
					$fail = $this->g[$fail][$i];
					$this->f[$this->g[$s][$i]] = $fail;
					$this->out[$this->g[$s][$i]] |= $this->out[$fail];
				}
			}
		}
		return $this;
	}

	function nextState(int $s, $ch)
	{
		$index = $ch - 33;
		while ($this->g[$s][$index] == -1)   ///If non-existing state, use failure function to support automaton.
		{
			$s = $this->f[$s];
		}
		return $this->g[$s][$index];
	}

	function search(array $arr, string $text)
	{
		$this->initialize($arr, $text)->buildMachine();
		$state = 0;
		$textArr = str_split($text);
		for ($i = 0; $i < count($textArr); $i++)
		{
			$state = $this->nextState($state, $textArr[$i]);
			if (count($this->out[$state]) > 0)
			{
				for ($j = 0; $j < count($arr); $j++)
				{
					if ($this->out[$state][$j])
					{
						echo $arr[$j] . " IS MATCHED AT POSITION: " . $i - strlen($arr[$j]) + 1 . "\n";
					}
				}
			}
		}
	}

}

$arr = ['he', 'she', 'hers', 'his', '!@#'];
$text = 'ahishers!@#';
$alg = new AhoCorasick();
$alg->search($arr, $text);
