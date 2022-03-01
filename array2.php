<?php 
echo "<pre>";
/*$data = [
	['category'=>1,'attribute'=>1,'option'=>1],
	['category'=>1,'attribute'=>1,'option'=>2],
	['category'=>1,'attribute'=>2,'option'=>3],
	['category'=>1,'attribute'=>2,'option'=>4],
	['category'=>2,'attribute'=>3,'option'=>5],
	['category'=>2,'attribute'=>3,'option'=>6],
	['category'=>2,'attribute'=>4,'option'=>7],
	['category'=>2,'attribute'=>4,'option'=>8]
];*/


//Method 1
/*$i = 0;
while($i < count($data)){
$result[$data[$i]['category']][$data[$i]['attribute']][$data[$i]['option']]= $data[$i]['option'];
$i++;
}
print_r($result);*/


//Method 2
/*$final = [];

foreach ($data as $row) {
	
	$categoryId = $row['category'];
	$attributeId = $row['attribute'];
	$optionId = $row['option'];

	if(!array_key_exists($categoryId, $final)){
		$final[$categoryId] = [];
	}

	if(!array_key_exists($attributeId , $final[$categoryId])){
		$final[$categoryId][$attributeId] = [];
	}

	$final[$categoryId][$attributeId][$optionId] = $optionId;
}
print_r($final);*/




$data = [
	'1'=>[
		'1' => [
			'1' => 1,
			'2' => 2		
		],
		'2' => [
			'3' => 3,
			'4' => 4		
		]
	],
	'2'=>[
		'3' => [
			'5' => 5,
			'6' => 6		
		],
		'4' => [
			'7' => 7,
			'8' => 8		
		]
	],
];


$final = [];
foreach ($data as $categoryId => $level1) {
	$row['categoryId'] = $categoryId;

	foreach($level1 as $attributeId => $level2){
		$row['attributeId'] = $attributeId;
	

		foreach($level2 as $optionId => $level3){
			$row['optionId'] = $optionId;
			array_push($final, $row);
			print_r($row);
		}	
	}
}








