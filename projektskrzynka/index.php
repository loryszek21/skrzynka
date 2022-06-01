<?php
session_start();

if((isset($_SESSION['zalogowany'])) && ($_SESSION['zalogowany']==true))
{
    header('Location: panel.php');
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

<form action="zaloguj.php" method="post">
    Login <input type="text" name="login">
    <br><br>
    Hasło <input type="password" name="haslo">
    <br><br>
        <input type="submit" value="Zaloguj" id="sendbutton">
</form>
<?php
if(isset($_SESSION['blad']))
echo $_SESSION['blad'];

?>

</body>
</html>