<?php

function arrayToJSObject($array, $varname, $sub = false ) {
    $jsarray = $sub ? $varname . "{" : $varname . " = {\n";
    $varname = "\t$varname";
    reset ($array);

    // Loop through each element of the array
    while (list($key, $value) = each($array)) {
        $jskey = "'" . $key . "' : ";
       
        if (is_array($value)) {
            // Multi Dimensional Array
            $temp[] = arrayToJSObject($value, $jskey, true);
        } else {
            if (is_numeric($value)) {
                $jskey .= "$value";
            } elseif (is_bool($value)) {
                $jskey .= ($value ? 'true' : 'false') . "";
            } elseif ($value === NULL) {
                $jskey .= "null";
            } else {
                static $pattern = array("\\", "'", "\r", "\n");
                static $replace = array('\\', '\\\'', '\r', '\n');
                $jskey .= "'" . str_replace($pattern, $replace, $value) . "'";
            }
            $temp[] = $jskey;
        }
    }
    $jsarray .= implode(', ', $temp);

    $jsarray .= "}\n";
    return $jsarray;
}

$fruits = array(
    array('id' => 1, 'name' => 'Apple', 'color' => 'Red'),
    array('id' => 2, 'name' => 'Orange', 'color' => 'Orange'),
    array('id' => 3, 'name' => 'Mango', 'color' => 'Yellow')
);
$random = array(
    array(1 => 1, 'value' => 25.5, 'spl' => array(
            'dblquote' => 'Test " Test',
            'sglquote' => "Test ' Test",
            'newline'  => "Test \n Test"
        )
    ),
    array('a' => 2, 'value' => true),
    array("name" => 3, 'value' => "Sumit")
);

?>
<html>
<head>
<title>PHP Array to JS Object</title>
</head>
<body>
<script type="text/javascript">
<!--
<?php
echo arrayToJSObject($fruits, 'fruits');
echo arrayToJSObject($random, 'random');

?>
alert(fruits);
alert(random[0].spl.newline);
alert(random[2].value);
//-->
</script>
</body>
</html>