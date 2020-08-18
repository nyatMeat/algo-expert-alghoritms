<?php

function balancedBrackets(string $string): bool
{
	$stack = [];
	$arr = str_split($string);
	$openingBrackets = ['(' => true, '[' => true, '{' => true];
	$closingBrackets = [')' => true, ']' => true, '}' => true];
	$matchingBrackets = [')' => '(', ']' => '[', '}' => '{'];
	foreach ($arr as $bracket)
	{

		//Если у нас открывающая скобка, то добавляем ее в стак
		if (isset($openingBrackets[$bracket]))
		{
			$stack[] = $bracket;
		}
		elseif (isset($closingBrackets[$bracket]))
		{
			//Если у нас пустой стак, и пришла закрывающая скобка, значит открывающей скобки не было, и значит скобки у нас не сбалансированы
			if (!count($stack))
			{
				return false;
			}
			//Если у нас последняя скобка равна скобке, открывающей, то удаляем из стака
			if ($stack[count($stack) - 1] == $matchingBrackets[$bracket])
			{
				array_pop($stack);
			}
			else
			{
				return false;
			}
		}
	}
	//Если у нас длина стака в конце концов равна нулю, значит скобки сбалансированы
	return count($stack) === 0;
}
