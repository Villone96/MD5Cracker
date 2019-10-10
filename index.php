<!DOCTYPE html>
<head><title>Giacomo Villa MD5 Cracker</title></head>
<body>
<h1>MD5 cracker</h1>
<p>This application takes an MD5 hash
of a four digit pin and 
attempts to hash all four digit combinations
to determine the original pin.</p>
<pre>
<?php
$goodtext = "";
if (isset($_GET['md5'])) {
    $time_pre = microtime(true);

    $hashValue = $_GET['md5'];
    $alphabet = "0123456789";
    $try = "";
    $firstDigit = "";
    $secondDigit = "";
    $thirdDigit = "";
    $fourthDigit = "";
    $pin = "";
    $show = 15;
    print "Debug Mode";
    echo "<table border = \"1\">";
    echo "<tr>";
    echo "<td><b>Hash Code</b>                       </td>";
    echo "<td><b>Pin</b> </td>";
    echo "</tr>";
    echo "</table>";

    for($i = 0; $i < strlen($alphabet); $i++) {
        $firstDigit = $alphabet[$i];

        for($j = 0; $j < strlen($alphabet); $j++) {
            $secondDigit = $alphabet[$j];

            for($z = 0; $z < strlen($alphabet); $z++) {
                $thirdDigit = $alphabet[$z];

                for($k = 0; $k < strlen($alphabet); $k++) {
                    $fourthDigit = $alphabet[$k];

                    $try = $firstDigit.$secondDigit.$thirdDigit.$fourthDigit;
                    $check = hash('md5', $try);

                    if ( $show > 0 ) {
                        $show = $show - 1;
                        echo "<table border = \"1\">";
                        echo "<tr>";
                        echo "<td>$check</td>";
                        echo "<td>$try</td>";
                        echo "</tr>";
                        echo "</table>";

                    }

                    if ($check == $hashValue) {

                        $pin = $try;
                        break 4;
                    }
                }
         
            }

        }

    }

    print "\n";
    print "\n";
    print "\n";
    $time_post = microtime(true);
    print "Elapsed time: ";
    print $time_post-$time_pre;
    print "\n";

    print "MD5 Hash Code: ";
    print $hashValue;
    print "\n";

    if (strlen($pin) != 0) {
        print "Pin: ";
        print $pin;
        print "\n";
    }
    else {
        print "Impossible retrieve original pin, check about hash code; are you sure that is MD5?";
    }

} elseif (! isset($_GET['md5'])) {
    print "Insert MD5 hash code";
}

?>
<form>
<input type="text" name="md5" size="32" />
<input type="submit" value="Crack MD5"/>
<ul>
<li><a href="index.php">Reset</a></li>
</ul>
</form>

