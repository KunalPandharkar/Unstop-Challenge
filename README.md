
# Unstop's Full Stack Developer Challenge


## Problem Statement

- There are 80 seats in a coach of a train with only 7 seats in a row and last row of only 3 seats. For simplicity, there is only one coach in this train.
- One person can reserve up to 7 seats at a time.
- If person is reserving seats, the priority will be to book them in one row.
- If seats are not available in one row then the booking should be done in such a way that the nearby seats are booked.

## Solution

- The problem scenario involves a train coach with 80 seats, arranged in rows. Each seat can be in one of two states: empty ('0') or booked ('1'). The seat status is represented by a string called "all_seats" with a **length of 80**.
- To persist the seat status, the string "all_seats" is stored in a database. This allows the program to save the changes made to the seat reservations.
- logic in code, **areSeatsAvailable()** function checks if a given row has a consecutive block of empty seats that can accommodate a specific number of seats. It takes a row of seats ($row) and the desired number of seats to be reserved ($numSeats)
- The **reserveSeats()** function is responsible for reserving seats in the train coach. It takes two parameters: the coach array ($coach) and the desired number of seats to be reserved ($numSeats).
- By storing the "all_seats" string in a database, the seat reservations can be persisted across different program runs. This allows the program to maintain the latest seat status even after restarting or closing the application.

## How to run application

- Download the project zip from the github [https://github.com/KunalPandharkar/Unstop-Challenge]
- Install all project dependencies by running command

```bash
  composer install
```
- Set up the environment file Copy the ***.env.example** file to **.env** in the project root.
- Update the **.env** file with the appropriate configuration details (database settings etc.) for your local environment.
- Generate an application key:
```bash
  php artisan key:generate
```
- Start the Xampp server. [MYSQL]
- Run database migrations:

```bash
  php artisan migrate:fresh
```
- ***Very Important :** database seeder which inserts the string with length of 80 in the table.
 
```bash
  php artisan db:seed
```
- Run the application:
```bash
  php artisan serve
```

## Files used in project


`app/Http/Controllers/TicketBookingController`

`database/migrations/`

`database/seeders/TicketbookingSeeder`

`resources/views/welcome.blade.php`

`resources/views/ticket-info.blade.php`

`routes/web.php`




## 🚀 About Me
Full stack web developer having an experience of developing and deploying successful projects as per 
client requirements and specifications, looking for a challenging role in reputable organization to utilize 
my skills


## 🔗 Links
[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://in.linkedin.com/in/kunal-pandharkar-513994188)

