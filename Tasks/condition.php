<?php

// if else 
$marks = 75;

if($marks < 35 )
echo "fail";
else 
echo "pass";
echo "<br>";


//else if 
if($marks > 0 && $marks < 35 )
	echo "fail";
elseif($marks > 35 && $marks <=65 )
	echo "Grade C";
elseif($marks > 65 && $marks <=85 )
	echo "Grade B";
elseif ($marks > 85 && $marks <=100) 
	echo "Grade A";
else
	echo "Invalid input";
echo "<br>";

//While loop
$n = 1;
while($n <= 7){
	echo "The number is: $n <br>";
	$n++;

}

echo "<br>";

//do while
$x = 1;

do {
  echo "The number is: $x <br>";
  $x++;
} while ($x <= 5);
echo "<br>";


//for loop
for ($x = 1; $x <= 10; $x++) {
  echo "The number is: $x <br>";
}


?>