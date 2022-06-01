<?php
session_start();

if (!isset($_SESSION['zalogowany']))
    {
        header('Location: index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
echo"<p>Witaj ".$_SESSION['imie'].'! [<a href="logout.php">Wyloguj się</a>]</p>';
// echo $_SESSION['nazwa_punktu'];

$polaczenie = new mysqli('localhost', 'root', '', 'skrzynki');
if (mysqli_connect_errno()===0){

        $zapytanie = "SELECT * FROM punkty";
        $wynik = $polaczenie->query($zapytanie);

?>

<table class="tabelka">
    <?php
echo "<tr><td> nazwa szkoły </td><td> miejscowość </td> <td> ilość skrzynek </td></tr>";
while($wiersz = $wynik->fetch_row()){
    echo "<tr><td>".$wiersz[1]."</td><td>".$wiersz[2]."</td><td>".$wiersz[3]."</td></tr>";
}
echo "</table>";

?>
<br><br><br>
<div class="form">
<form action="panel.php" method="post">
        
<select name="opcja" id="" required>
    
<?php

    $zapytanie2 = "SELECT nazwa_punktu, miejscowosc, ilosc_skrzynek FROM punkty ";
    $wynik = $polaczenie->query($zapytanie);
    while($wiersz = $wynik->fetch_row()){
    echo "<option>".$wiersz[1]."</option>" ;
    // ." &nbsp". $wiersz[2]."".$wiersz[3].
       
    }
?>
</select>
    <input type="number" name="liczba" id="" min="-99" max="99" required>
  <input type="submit" value="wyślij" >
        


        <?php
if(isset($_POST['opcja']) && isset($_POST['liczba'])){
       $opcja = $_POST['opcja'];
       $liczba = $_POST['liczba'];
    
        $zapytanie3 = "SELECT ilosc_skrzynek FROM punkty WHERE nazwa_punktu = '$opcja'";
    $wynik3 = $polaczenie->query($zapytanie3);
   while($wiersz3 = $wynik3->fetch_row()){
    echo $wiersz3[0];
    $ilosc = $wiersz3[0];
    }

        $liczba += $ilosc;
     $zapytanie_do_bazy = "UPDATE punkty SET ilosc_skrzynek = $liczba WHERE nazwa_punktu = '$opcja'" ;
     if ($polaczenie->query($zapytanie_do_bazy) === TRUE) {
  echo "Sukces";
  header('Location: panel.php');
} else {
  echo "Lol nie działa: " . $polaczenie->error;
}
     
   echo " ".$liczba.
   " ";
}

}else{
    mysqli_connect_error();
    exit;
}
mysqli_close($polaczenie);

?>
</div>
</form>
</body>
</html>