A warmup for using PHP and regex.

Doesn't support parentheses (can't with regex), but will filter out
Can't put + sign in fr	ont of numbers
Must put 0 in front of decimals (ie 0.4)

invalid expressions and division by zero.

PHP 5.4+ has built in webserver:
php -S localhost:8000 calculator.php

CalculatorTest runs tests on validating expressions and checking for divison by 0
Testing done with phpunit 4.8

Dependenies Manages with Composer
run $composer install
this will create a vendor directory

run $vendor/bin/phpunit Calculator.test to run tests