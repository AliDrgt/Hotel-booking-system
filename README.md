# CSE 348 Database Management Systems Term Project

## Project Overview

This project is a comprehensive database management system for managing hotel bookings in Turkey. Developed as part of the CSE 348 Database Management Systems course, it provides functionalities for creating and managing hotels, clients, rooms, facilities, and travel agencies. The project demonstrates proficiency in database design, SQL, and PHP.

## Features

- **Dynamic Database Creation:** Automatically sets up the database and tables needed for the application.
- **CSV Data Import:** Imports data from CSV files to populate the database with sample data.
- **Comprehensive Entity Management:** Manages entities such as districts, cities, hotels, clients, facilities, rooms, room types, and travel agents.
- **Booking System:** Allows for booking management, including check-in, check-out, and booking dates.
- **Reporting and Analytics:** Provides detailed reports and analytics on hotel bookings, room availability, and agency performance.

## Project Structure

- **data/**: Contains CSV files with data for the project.
    - `booking.csv`
    - `city.csv`
    - `client.csv`
    - `districts.csv`
    - `facility.csv`
    - `hotels.csv`
    - `rooms.csv`
    - `roomtypes.csv`
    - `travelagents.csv`
- **sql/**: Contains the SQL script to create and populate the database.
    - `database_setup.sql`
- **install.php**: Script to set up the database and import data from CSV files.

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/yourusername/CSE348-hotel-booking-system.git
    ```
2. **Navigate to the project directory:**
    ```sh
    cd CSE348-hotel-booking-system
    ```
3. **Set up your database with the required tables by running the `install.php` script:**
    ```sh
    php install.php
    ```

## Usage

### Database Setup
- Run the `install.php` script to create the database and import the data from the CSV files.
    ```sh
    php install.php
    ```


## Usage

Open the relevant PHP files in your browser to interact with the database and perform reporting actions.

## Acknowledgments

This project was created by Ali Durgut.
