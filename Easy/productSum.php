<?php
/**
 * sum for products for array [1,2,[2,3],5,[1,[5,6]]]
 * O(n) - time
 * O(d) - space
 * @param array $products
 * @param int $multiplier
 * @return int
 */
function productSum(array $products, int $multiplier = 1): int
{
	$sum = 0;
	foreach ($products as $product)
	{
		if (is_array($product))
		{
			$sum += productSum($product, $multiplier + 1);
		}
		else
		{
			$sum += $product;
		}
	}
	return $sum * $multiplier;
}
