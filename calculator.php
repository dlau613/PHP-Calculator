<!DOCTYPE html>
<html>
<body>
<h1>Calculator</h1>
Daniel Lau<br/>
Type an expression in the following box (e.g., 10.5+20*3/25).
<p>
    <form method="GET">
        <input type="text" name="expr">
        <input type="submit" value="Calculate">
    </form>
</p>

<ul>
    <li>Only numbers and +,-,* and / operators are allowed in the expression.
    <li>The evaluation follows the standard operator precedence.
    <li>The calculator does not support parentheses.
    <li>The calculator handles invalid input "gracefully". It does not output PHP error messages.
</ul>

Here are some (but not limit to) reasonable test cases:
<ol>
  <li> A basic arithmetic operation:  3+4*5=23 </li>
  <li> An expression with floating point or negative sign : -3.2+2*4-1/3 = 4.46666666667, 3*-2.1*2 = -12.6 </li>
  <li> Some typos inside operation (e.g. alphabetic letter): Invalid input expression 2d4+1 </li>
</ol> 


<?php 
// grab the expression and process
$expr = $_GET["expr"];
echo process_input($expr);
?>

<?php
function process_input($expr) {
  // sanitize the expression
  // $clean = sanitize_input($expr);
  $clean = $expr;
  // add a space between consecutive negative signs
  $clean = preg_replace("~\-{2}~", "- -",$clean);

  // replace multiple spaces with one space
  $clean = preg_replace("~\s+~", " ",$clean);

  if (empty_or_zero($clean)) {
    return "";
  }

  echo "<h2>Result</h2>";
  if (valid_expression($clean) ) {
    if (division_by_zero($clean)) {
      // echo "Division by zero error! <br>";
      return "Division by zero error!";
    }
    else {
      $result = eval('return ' . $clean . ';');
      // echo $clean." = ".$result."<br>";
      return trim($clean)." = ".$result;
    }
  }
  else {
    // echo "Invalid expression!<br>";
    return "Invalid expression!";
  }
}

/* emptry string "" or "0" should do nothing
"  0" and "0  " should still output 0 = 0 so only match "0"
for some reason $expr == "0" didnt work*/
function empty_or_zero($expr) {
  if ($expr == "" || preg_match("~^0$~",$expr)) {
    return true;
  }
  return false;
}
function division_by_zero($expr) {
  // \/\s*\-? division sign followed by zero or more spaces followed by optional minus sign
  // 0(\.0+)? zero followed by optional dot and 1 or more zeros
  // [\s*+\-*/] zero or more spaces or an operator
  // ([.......]|$) or end of line
  $divideByZero = "~\/\s*\-?0(\.0+)?([\s*+\-*/]|$)~";
  if (preg_match($divideByZero, $expr)) {
    return true;
  }
  return false;
}

/* return true if valid else false 
dont worry about fractions without a leading 0, ie .2
dont worry about leading + signs, only check for leading - signs ie 3*-2
*/
function valid_expression($expr) {
  // $expr = sanitize_input($expr);
  // ^ beginning of line
  // \s*\-? optional whitespace and optional minus sign
  // ([1-9]\d*|0) one or more digits or just a 0
  // (\.\d+)? optional dot followed by one or more numbers
  // \s* optional zero or more spaces
  // [+\-*/\]\s\-?([1-9]\d*|0)(\.\d+)?\s* any of those operators, followed by 0 or more spaces, followed by optional minus sign, followed by another int or float, followed by 0 or more spaces
  // ( )* the whole expression (operator followed by number/float) repeated zero or more times
  // $valid = "~^\s*\-?\d+(\.\d+)?\s*([+\-*/]\s*\-?\d+(\.\d+)?\s*)*$~";
  $valid = "~^\s*\-?([1-9]\d*|0)(\.\d+)?\s*([+\-*/]\s*\-?([1-9]\d*|0)(\.\d+)?\s*)*$~";
  if (preg_match($valid, $expr)) {
    return true;
  }
  return false;
}

function sanitize_input($data) {
  // $data = trim($data);
  // $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

</body>
</html>