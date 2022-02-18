<?php

echo '<pre>';


class Product
{
		public $price = 0;
		public function setPrice($price)
		{
				$this->price = $price;
				return $this;
		}

		public function getPrice()
		{
				return this->price;
		}
}
$p1 -> new Product();
print_r($p1);



?>