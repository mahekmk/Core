<?php

echo "<pre>";


$var1 = "Mahek";

$var2 = 30 ;
$var3 = True;

echo($var1);  // echo() for int and string
echo "<br>";
echo($var2);
echo "<br>";
echo($var3);
echo "<br>";

var_dump($var1); // var_dump() for int, string , boolean , object , array  for knowing data type , length and output 
echo "<br>";
var_dump($var2);
echo "<br>";
var_dump($var3);
echo "<br>";

$product = [
		'name' => 'apple',
		'price' => '100'
];

print_r($product);

class A{

}

echo "<br>";
$object_of_class_A = new A();
print_r($object_of_class_A);

?>