CREATE TABLE punkty( id_punktu INT(10) AUTO_INCREMENT PRIMARY KEY , nazwa_punktu
varchar(255), miejscowosc varchar(255)) CREATE TABLE pracownik( id_pracownika
INT(10) AUTO_INCREMENT NOT NULL PRIMARY KEY, imie VARCHAR(255), login
VARCHAR(255), haslo VARCHAR(255) ) INSERT INTO `punkty`( `nazwa_punktu`,
`miejscowosc`, `ilosc_skrzynek`) VALUES ('szkoła rudna','Rudna','0')

