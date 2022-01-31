<?php
// Check that the class exists before trying to use it

echo "<pre>";


echo "1. class_alias";
echo '<br>';
class foo{}
class_alias('foo' , 'bar');

$a = new foo();
$b = new bar();

var_dump($a == $b , $b == $a);
var_dump($a instanceof $b);
var_dump($a instanceof foo);
var_dump($a instanceof bar);
var_dump($b instanceof foo);
var_dump($b instanceof bar);
echo '<br>';

echo '2. class_exists';
echo '<br>';
if (class_exists('foo')){
    $c = new foo();
    print_r($c);
}
echo '<br>';

echo '3. get_called_class';
echo '<br>';
class foo1 {
    static public function test() {
        var_dump(get_called_class());
    }
}

class bar1 extends foo1 {
}

foo1::test();
bar1::test();
echo '<br>';

echo '4. get_class_method()';
echo '<br>';
class myclass1 {
    // constructor
    function __construct()
    {
        return(true);
    }

    // method 1
    function myfunc1()
    {
        return(true);
    }

    // method 2
    function myfunc2()
    {
        return(true);
    }
}

$class_methods = get_class_methods('myclass1');
// or
$class_methods = get_class_methods(new myclass1());

foreach ($class_methods as $method_name) {
    echo "$method_name\n";
}
echo '<br>';

echo '5. get_class_var';
echo '<br>';
class Demo
{
    var $myvar1 = 'ab';
    var $myvar2 = 'cd';
    var $myvar3 = 8;
    var $myvar4 = 54;

    function Demo() {
         $this->myvar1 = "xy";
         $this->myvar2 = "abcd";
         return true;
      }
   }
   $hello_class = new Demo();
   $class_vars = get_class_vars(get_class($hello_class));

   foreach ($class_vars as $name => $value) {
      echo "$name = $value \n";
   }
echo '<br>';


echo '6. get_class';
echo '<br>';
   class foo2 {
    function name()
    {
        echo "My name is " , get_class($this) , "\n";
    }
}

// create an object
$bar2 = new foo2();

// external call
echo "Its name is " , get_class($bar2) , "\n";

// internal call
$bar2->name();
echo '<br>';

echo '7. get_declared_class';
echo '<br>';
print_r(get_declared_classes());
echo '<br>';

echo '8. get_declared_interfaces';
echo '<br>';
print_r(get_declared_interfaces());
echo '<br>';


echo '9. get_object_vars';
echo '<br>';
class foo3 {
    private $a;
    public $b = 1;
    public $c;
    private $d;
    static $e;
   
    public function test() {
        var_dump(get_object_vars($this));
    }
}

$test = new foo3;
var_dump(get_object_vars($test));

$test->test();


echo '<br>';
echo '10. get_parent_class';
echo '<br>';

class Dad {
    function __construct()
    {
    }
}

class Child extends Dad {
    function __construct()
    {
        echo "I'm " , get_parent_class($this) , "'s son\n";
    }
}

class Child2 extends Dad {
    function __construct()
    {
        echo "I'm " , get_parent_class('child2') , "'s son too\n";
    }
}

$foo4 = new child();
$bar4= new child2();




echo '<br>';
echo '11. get_declared_traits';
echo '<br>';

//namespace Example;

trait fooTraits
{
}

abstract class fooAbstract
{

}

class Bar5 extends fooAbstract
{
    use fooTraits;
}

$array = get_declared_traits();
var_dump($array);


echo '<br>';
echo '12. interface_exists()';
echo '<br>';

if(interface_exists('MyInterface'))
{
    class MyClass implements MyInterface
    {
        //methods
    }

}

echo '<br>';
echo '13. is_a()';
echo '<br>';

class foo6 { 

}
$a = new foo6;

if(is_a($a,'foo6'))
    echo 'yes, a is object of foo6.';

echo '<br>';
echo '<br>';
echo '14. is_subclass_of()';
echo '<br>';

class dadJohn{

}

class childMike extends dadJohn{
}

$dad = new dadJohn();
$child = new childMike();


if(is_subclass_of('childMike', 'dadJohn'))
    echo 'yes child classMike is subclass of dadJohn class.';
else 
    echo 'no child classMike is not subclass of dadJohn class.';

echo '<br>';
echo '<br>';
echo '15. method_exists()';
echo '<br>';

$directory = new Directory('.');
var_dump(method_exists($directory,'read'));

echo '<br>';
echo '<br>';
echo '16. property_exists()';
echo '<br>';

class myClass {
    public $mine;
    private $xpto;
    static protected $test;

    static function test() {
        var_dump(property_exists('myClass', 'xpto')); //true
    }
}

var_dump(property_exists('myClass', 'mine'));   //true
var_dump(property_exists(new myClass, 'mine')); //true
var_dump(property_exists('myClass', 'xpto'));   //true
var_dump(property_exists('myClass', 'bar'));    //false
var_dump(property_exists('myClass', 'test'));   //true
myClass::test();


echo '<br>';
echo '<br>';
echo '17. trait_exists()';
echo '<br>';


if(trait_exists('fooTraits'))
    echo "footraits exists";

echo '<br>';
echo '<br>';
echo '18. get_mangled_object_vars()';
echo '<br>';

class A
{
    public $public =1;
    protected $protected =2;
    private $private = 3;

}

class B extends A
{
    private $private = 4;
}
$object = new B;
$object->dynamic = 5;
$object->{'6'} = 6;

var_dump(get_mangled_object_vars($object));

class AO extends ArrayObject
{
    private $private = 1;
}

$arrayObject = new AO(['x' => 'y']);
$arrayObject->dynamic = 2;

var_dump(get_mangled_object_vars($arrayObject));


echo '<br>';
echo '<br>';
echo '19. enum_exists';
echo '<br>';

enum checkGender:string{
    case MALE = 'male';
    case Female = 'female';
}


if (enum_exists(checkGender::class)) {
  echo "Valid ";
} else {
  echo "not valid";
}


echo '<br>';
echo '<br>';
echo '20. function_exists';
echo '<br>';


if (function_exists('myfunc11')) {
    echo "myfunc11 functions are available.<br />\n";
} else {
    echo "myfunc11 functions are not available.<br />\n";
}



?>