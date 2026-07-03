<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/main.css">
    <title>Document</title>
</head>
<body>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">

    <input type="number" name="num1" placeholder="First Number">

    <select name="operator">
        <option value="add">+</option>
        <option value="substract">-</option>
        <option value="multiply">*</option>
        <option value="divide">/</option>
    </select>

    <input type="number"name="num2" placeholder="Second Number">

    <button>Calculate</button>
    </form>

    <?php   
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  //As default, whenever we load a page inside a browser, it is set to the GET method. So, this code will run no matter what.

     //$num1 = $_POST["num1"]; --> //Grabbing Data (But not secure)

    //Grab Data from Inputs
    $num1 = filter_input(INPUT_POST, "num1", FILTER_SANITIZE_NUMBER_FLOAT);

    $num2 = filter_input(INPUT_POST, "num2", FILTER_SANITIZE_NUMBER_FLOAT);

    $operator = htmlspecialchars($_POST["operator"]);

    // Error Handlers
    $errors = FALSE;

    if (empty($num1) || empty($num2) || empty($operator)) {
        echo "<p class='calc-error'>Fill in the all fields!</p>";
        $errors = TRUE;
    }

    if (!is_numeric($num1) || !is_numeric($num2)) {
        echo "<p class='calc-error'>Only insert numbers!</p>";
        $errors = TRUE;
    }


    // Calculate the numbers if no errors
    if (!$errors) {
        $value = 0;

        switch ($operator) {
            case "add":
                $value = $num1 + $num2;
                break;
            case "substract":
                $value = $num1 - $num2;
                break;
            case "multiply":
                $value = $num1 * $num2;
                break;
            case "divide":
                if ($num2 == 0) {
                    echo "<p class='calc-error'>Cannot divide by zero!</p>";
                    $errors = TRUE;
                } else {
                    $value = $num1 / $num2;
                }        
                break;
            default:
                echo "<p class='calc-error'>Something went HORRIBLY Wrong!</p>";
        }

        if(!$errors){
        echo "<p class='calc-result'>Result = " . $value . "</p>";
        }
    }




     


    } 
    ?>


    
</body>
</html>