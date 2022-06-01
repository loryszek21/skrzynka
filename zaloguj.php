<?php
session_start();

if ((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
{
    header('Location: index.php');
    exit();
}

require_once "connect.php";

$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0){
    echo "Error:".$polaczenie->connect_errno;
}else
{


$login =$_POST['login'];
$haslo =$_POST['haslo'];

$login = htmlentities($login, ENT_QUOTES, "UTF-8");
$haslo = htmlentities($haslo, ENT_QUOTES, "UTF-8");



if ($rezultat = @$polaczenie->query(
sprintf("SELECT * FROM pracownik WHERE login='%s' AND haslo='%s'",
mysqli_real_escape_string($polaczenie, $login), 
mysqli_real_escape_string($polaczenie, $haslo))))
{
    $ile_userow = $rezultat->num_rows;
    if($ile_userow>0)
    {

$_SESSION['zalogowany']=true;

        $wiersz = $rezultat->fetch_assoc();
        $_SESSION['id'] = $wiersz['id_pracownika'];
        $_SESSION['imie'] = $wiersz['imie'];
        
        
        unset($_SESSION['blad']);
        $rezultat->free();
        header('Location: panel.php');

    }else{
        $_SESSION['blad']='Nieprawidłowy login lub hasło';
        header('Location: index.php');
    }
}

$polaczenie->close();
}





?>
