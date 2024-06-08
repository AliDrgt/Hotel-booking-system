<?php
$servername = "localhost";
$username = "root";
$password = "mysql";

$connection = mysqli_connect($servername, $username, $password);

if (!$connection) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected to database\n";

$sql = "DROP DATABASE IF EXISTS hotel_booking_system";
$result = mysqli_query($connection, $sql);
$sql = "CREATE DATABASE IF NOT EXISTS hotel_booking_system";
$result = mysqli_query($connection, $sql);
if ($connection->query($sql) === TRUE) {
    echo "Database created successfully\n";
} else {
    echo "Error creating database: " . $connection->error;
}
$connection->close();

// ALI FATIH DURGUT 20190702068

$connection = mysqli_connect($servername, $username, $password);
$sql = "USE hotel_booking_system;";

$result = mysqli_query($connection, $sql);

$sql = "CREATE TABLE IF NOT EXISTS `Districts`(
        `district_id` INT NOT NULL AUTO_INCREMENT,
        `district_name` VARCHAR(45) NOT NULL,
        PRIMARY KEY (`district_id`))
        ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(10);

$sql = "CREATE TABLE IF NOT EXISTS `Citys` (
    `city_id` INT NOT NULL AUTO_INCREMENT,
    `city_name` VARCHAR(45) NOT NULL,
    `Districts_district_id` INT NOT NULL,
    PRIMARY KEY (`city_id`),
    INDEX `fk_Citys_Districts_idx` (`Districts_district_id` ASC) VISIBLE,
    CONSTRAINT `fk_Citys_Districts`
      FOREIGN KEY (`Districts_district_id`)
      REFERENCES `Districts` (`district_id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(11);

$sql = "CREATE TABLE IF NOT EXISTS `Hotels` (
  `hotel_id` INT NOT NULL AUTO_INCREMENT,
  `hotel_name` VARCHAR(45) NOT NULL,
  `Citys_city_id` INT NOT NULL,
  PRIMARY KEY (`hotel_id`),
  INDEX `fk_Hotels_Citys1_idx` (`Citys_city_id` ASC) VISIBLE,
  CONSTRAINT `fk_Hotels_Citys1`
    FOREIGN KEY (`Citys_city_id`)
    REFERENCES `Citys` (`city_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(12);

$sql = "CREATE TABLE IF NOT EXISTS `Facilities` (
    `facility_id` INT NOT NULL AUTO_INCREMENT,
    `facility_name` VARCHAR(45) NOT NULL,
    `Hotels_hotel_id` INT NOT NULL,
    PRIMARY KEY (`facility_id`),
    INDEX `fk_Facilities_Hotels1_idx` (`Hotels_hotel_id` ASC) VISIBLE,
    CONSTRAINT `fk_Facilities_Hotels1`
        FOREIGN KEY (`Hotels_hotel_id`)
        REFERENCES `Hotels` (`hotel_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(13);

$sql = "CREATE TABLE IF NOT EXISTS `RoomType` (
    `roomtype_id` INT NOT NULL,
    `roomtype_name` VARCHAR(45) NOT NULL,
    `room_price` INT NOT NULL,
    PRIMARY KEY (`roomtype_id`))
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(14);

$sql = "CREATE TABLE IF NOT EXISTS `TravelAgents` (
    `travelagent_id` INT NOT NULL AUTO_INCREMENT,
    `travelagent_name` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`travelagent_id`))
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(15);

$sql = "CREATE TABLE IF NOT EXISTS `Client` (
    `client_id` INT NOT NULL AUTO_INCREMENT,
    `client_name` VARCHAR(45) NOT NULL,
    `client_surname` VARCHAR(45) NOT NULL,
    PRIMARY KEY (`client_id`))
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(16);

$sql = "CREATE TABLE IF NOT EXISTS `Rooms` (
    `room_number` INT NOT NULL AUTO_INCREMENT,
    `RoomType_roomtype_id` INT NOT NULL,
    `Hotels_hotel_id` INT NOT NULL,
    PRIMARY KEY (`room_number`),
    INDEX `fk_Rooms_RoomType1_idx` (`RoomType_roomtype_id` ASC) VISIBLE,
    INDEX `fk_Rooms_Hotels1_idx` (`Hotels_hotel_id` ASC) VISIBLE,
    CONSTRAINT `fk_Rooms_RoomType1`
        FOREIGN KEY (`RoomType_roomtype_id`)
        REFERENCES `RoomType` (`roomtype_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_Rooms_Hotels1`
        FOREIGN KEY (`Hotels_hotel_id`)
        REFERENCES `Hotels` (`hotel_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(17);

$sql = "CREATE TABLE IF NOT EXISTS `Booking` (
    `booking_id` INT NOT NULL AUTO_INCREMENT,
    `check_in` DATE NOT NULL,
    `check_out` DATE NOT NULL,
    `booking_date` DATE NOT NULL,
    `Rooms_room_number` INT NOT NULL,
    `Client_client_id` INT NOT NULL,
    `TravelAgents_travelagent_id` INT NOT NULL,
    PRIMARY KEY (`booking_id`),
    INDEX `fk_Booking_Rooms1_idx` (`Rooms_room_number` ASC) VISIBLE,
    INDEX `fk_Booking_Client1_idx` (`Client_client_id` ASC) VISIBLE,
    INDEX `fk_Booking_TravelAgents1_idx` (`TravelAgents_travelagent_id` ASC) VISIBLE,
    CONSTRAINT `fk_Booking_Rooms1`
        FOREIGN KEY (`Rooms_room_number`)
        REFERENCES `Rooms` (`room_number`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_Booking_Client1`
        FOREIGN KEY (`Client_client_id`)
        REFERENCES `Client` (`client_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
    CONSTRAINT `fk_Booking_TravelAgents1`
        FOREIGN KEY (`TravelAgents_travelagent_id`)
        REFERENCES `TravelAgents` (`travelagent_id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB";
$result = mysqli_query($connection, $sql) or die(18);

$file = fopen("districts.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Districts(district_id, district_name) VALUES('$data[0]', '$data[1]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("client.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Client(client_id, client_name, client_surname) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("city.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Citys(city_id, city_name, Districts_district_id) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("hotels.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Hotels(hotel_id, hotel_name, Citys_city_id) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("facility.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Facilities(facility_id, facility_name, Hotels_hotel_id) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("roomtypes.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO RoomType(roomtype_id, roomtype_name, room_price) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("rooms.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Rooms(room_number, RoomType_roomtype_id, Hotels_hotel_id) VALUES('$data[0]', '$data[1]', '$data[2]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("travelagents.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO TravelAgents(travelagent_id, travelagent_name) VALUES('$data[0]', '$data[1]')"; 
    $connection->query($sql);
}
fclose($file);

$file = fopen("booking.csv", "r");
while (($data = fgetcsv($file, 1000, ";")) !== FALSE) {
    $sql = "INSERT INTO Booking(booking_id, check_in, check_out, booking_date, Rooms_room_number, Client_client_id, TravelAgents_travelagent_id) VALUES('$data[0]', '$data[1]', '$data[2]', '$data[3]', '$data[4]', '$data[5]', '$data[6]')"; 
    $connection->query($sql);
}
fclose($file);

?>
