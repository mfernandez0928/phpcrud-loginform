<?php 
    require('./rectangle.php');

    $object1 = new Rectangle();
    $object2 = new Rectangle();

    $object1->length = 30; // arrow symbol (->) is an OOP construction that is used to access properties and method.
    $object1->width = 20;

    $object2->length = 40;
    $object2->width = 30;

    echo "<b>PHP Class and Object Examples</b><br> <br>";
    echo "Object 1 Rectangle: <b>" . $object1->getArea(). "</b><br> ";
    echo "Object 2 Rectangle: <b>" . $object2->getArea(). "</b><br> ";
    echo "<br>";
    echo "Object 1 Rectangle Perimeter: <b> " . $object1->getPerimeter(). "</b><br> ";
    echo "Object 2 Rectangle Perimeter: <b>" . $object2->getPerimeter(). "</b><br> ";

    echo "<br>";

    $object3 = new Square();
    $object3->length = 30;
    $object3->width = $object3->length;

    if ($object3->isSquare()) {
        echo "The Ares of the Square: <b>". $object3->getArea(). "</b><br> ";
    } else {
        echo "The Ares of the Rectangle: <b>". $object3->getArea(). "</b><br> ";
    }

    // echo "Object 3 Square Area: <b>" . $object3->getArea(). "</b><br> ";
?>