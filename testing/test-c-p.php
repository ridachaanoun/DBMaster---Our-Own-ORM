<?php

require '../Config.php';
require '../Database.php';
require '../ORM.php';
require '../ORMInterface.php';
require "../Product.php";
// Add columns to thetable
Product::addProductColumn('name', 'VARCHAR(255) NOT NULL');
Product::addProductColumn('price', 'int');


// Create the Product table
echo "Creating Product table...<br>";
if (Product::setupTable()) {
    echo "Product table created successfully.<br>";
} else {
    echo "Failed to create Product table.<br>";
}

?>