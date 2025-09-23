<h1>This is my first PHP file</h1>
<?php
// http://localhost:8008/?x=5&y=10

$x = $_GET["x"];
$y = $_GET["y"];

// Arithmetic operators +, -, *, /, %
echo "x + y = " . ($x + $y) . "<br>";

// others
// Comparison operators: ==, !=, <, >, <=, >=
echo "x == y: " . ($x == $y) . "<br>";
?>
