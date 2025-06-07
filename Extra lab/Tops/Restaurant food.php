<?php

$dish = "icecream";

//
switch ($dish) {
    case "salad":
        echo "Category: Starter<br>";
        echo "Dish: Fresh Garden Salad<br>";
        echo "Dish: Soup<br>";
        echo "Dish : Spring rolls<br>";
        echo "Dish : Paneer tika";
        break;
        
    case "soup":
        echo "Category: Starter<br>";
        echo "Dish: Tomato Basil Soup";
        break;
        
    case "paneer":
        echo "Category: Main Course<br>";
        echo "Dish: Paneer Butter Masala <br>";
        echo "Dish: Dal makhni <br>";
        echo "Dish: Chhole ";
        break;
        
     
    case "icecream":
        echo "Category: Dessert<br>";
        echo "Dish: Vanilla Ice Cream<br>";
        echo "Dish: Cake";
        break;
    
        
    default:
        echo "Invalid dish selected.";
}
?>
