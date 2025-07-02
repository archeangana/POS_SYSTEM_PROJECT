<?php
      include "./autoload.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Test Web</title>
</head>
<body>


      <?php
            $person = new Person('Arche', 23, 'Male');
            echo $person->name . "<br>";
            echo "<br> Person Details:";
            foreach ($person as $key => $value) {
                  echo "<br>" . ucfirst($key) . ": {$value}";
            }

            Person::setIsActive(true);
            $isActive = Person::getIsActive() ? " Yes" : " No";
            echo "<br> Is the person active? " . $isActive;

      

      ?>

      <form action="" method="post">


      </form>


      
</body>
</html>