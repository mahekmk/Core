<?php

echo "<pre>";
//  1. array_change_key_case()
$input_array = [
			'name' => 'Mahek',
			'enrollment' => '180570107054'];
print_r(array_change_key_case($input_array, CASE_LOWER));
echo "<br>";


// 2. array_chunk()
$fruits = ['Apple' , 'Banana' , 'Cherry' , 'Dates' , 'Grapes' , 'Jackfruit' , 'Kiwi'];
print_r(array_chunk($fruits, 3));
echo "<br>";

// 3. array_column()
$records = [[
			'id' => '1',
			'first_name' => 'Mahek',
			'last_name' => 'Kalola',
			 ],

			[
			'id' => '2',
			'first_name' => 'Rushil',
			'last_name' => 'Kalola',
			],

			[
			'id' => '3',
			'first_name' => 'Abc',
			'last_name' => 'def',
			]];

$first_name = array_column($records,'first_name');
print_r($first_name);
echo "<br>";

$id = array_column($records,'id');
print_r($id);
echo "<br>";

// 4. array_combine()
 
$fruit = array('apple' , 'banana' , 'Grapes');
$color = array('red' , 'yellow' , 'green');
$fruit_color = array_combine($fruit, $color);

print_r($fruit_color);
echo "<br>";

// 5. array_count_values()
$fruit = array('apple' , 'banana' , 'Grapes','banana', 'Grapes');
print_r(array_count_values($fruit));
echo "<br>";

// 6. array_diff_assoc()
$array1 = ['id' => '1' , 'name' => 'Mahek' , 'kalola'];
$array2 = ['id' => '1' , 'name'=>'Rushil' , 'Patel'];
$result = array_diff_assoc($array2 , $array1);
print_r($result);
echo "<br>";
var_dump($result);
echo "<br>";


// 7. array_diff_key()
$color1 = array('blue' => '1' , 'red' => '2' , 'yellow' => '3' , 'ochre' => '7' , 'blue' => '2');
$color2 = array('blue' => '1' , 'green' => '2' , 'black' => '7');
$color3 = array('red' => '3' , 'brown' => '9');

print_r(array_diff_key($color1, $color2 , $color3));
echo "<br>";

// 8. array_diff()

$color1 = array( '1' => 'blue' , 'red' , 'yellow'  , 'ochre' , 'red');
$color2 = array( '2' => 'red' , 'ochre' );
print_r(array_diff($color1, $color2));
echo "<br>";


// 9. array_fill_keys() => fill the values of given key

$keys = array('foo', 5, 10, 'bar');
$a = array_fill_keys($keys, 'banana');
print_r($a);
echo "<br>";

// 10. array_fill() => fill the values of given key index range
 
$a = array_fill(2, 6, 'banana');
$b = array_fill(-3, 4, 'apple');
print_r($a);
echo "<br>";
print_r($b);
echo "<br>";

// 11. array_flip() => key becomes value value becomes key.

$color = ['red' , 'blue' , 'green'];
$flipped = array_flip($color);
var_dump($flipped);
echo "<br>";

// 12. array_intersect_assoc() => checks intersection along with key value both

$color1 = array('blue' => '1' , 'red' => '2' , 'yellow' => '3' , 'ochre' => '7' );
$color2 = array('blue' => '1' , 'green' => '2' , 'red' => '7');
$result = array_intersect_assoc($color1, $color2);
print_r($result);
echo "<br>";


// 13. array_intersect_key() => checks intersection of only keys

$color1 = array('blue' => '1' , 'red' => '2' , 'yellow' => '3' , 'ochre' => '7' );
$color2 = array('blue' => '3' , 'green' => '2' , 'red' => '7');
$result = array_intersect_key($color2, $color1);
print_r($result);
echo "<br>";


// 14. array_intersect() => checks intersection of only values

$color1 = array('blue' => '1' , 'red' => '2' , 'yellow' => '3' , 'ochre' => '7' );
$color2 = array('blue' => '3' , 'green' => '2' , 'black' => '7');
$result = array_intersect($color1, $color2);
print_r($result);
echo "<br>";


// 15. array_key_exists() => checks if key exists


$color = ['red' => '1' , 'blue' => '2' , 'green' => '3'];
if (array_key_exists('black', $color))
	echo 'The key is in list.';
else
	echo 'The key not in list.';
echo "<br>";

// 16.  array_key_first() 

$array = ['apple' => 1, 'banana' => 2, 'cherry' => 3];
$firstKey = array_key_first($array);
var_dump($firstKey);
echo "<br>";


// 17. array_key_last()

$array = ['apple' => 1, 'banana' => 2, 'cherry' => 3];
$firstKey = array_key_last($array);
var_dump($firstKey);
echo "<br>";

// 18. array_keys()

$array = array(0 => 100, "color" => "red");
print_r(array_keys($array));

$array = array("blue", "red", "green", "blue", "blue");
print_r(array_keys($array, "blue"));

$array = array("color" => array("blue", "red", "green"),
               "size"  => array("small", "medium", "large"));
print_r(array_keys($array));

echo "<br>";

// 19. array_merge()


$color1 = array('blue' => '1' , 'red' => '2' , 'yellow' => '3' , 'ochre' => '7' );
$color2 = array('blue' => '3' , 'green' => '2' , 'red' => '7');
$result = array_merge($color1, $color2);
print_r($result);

// 20. array_merge_recursive()

$ar1 = array("color" => array("favorite" => "red"), 5);
$ar2 = array(10, "color" => array("favorite" => "green", "blue"));
$result = array_merge_recursive($ar1, $ar2);
print_r($result);


?>

