<?php

date_default_timezone_set('Asia/Kolkata');
date_default_timezone_get();
echo date("h:i:sa");


$currentDay = date("l");

if ($currentDay === "Sunday") {
    echo "Happy Sunday!";
} else {
    echo "Today is $currentDay.";
}
?>
