# HW5-Stress-Testing

To run siege check use:

run.sh [NUMER OF CONCURRENT USERS]

Siege urls ./etc/siege/urls.txt

Default database has 100 000 uniq clients record without indexes.

DB structure ./etc/mysql/Client_structure.sql

web serever acepts next urls:

http://localhost:8000/?add_records=NUMBER - insert in to DB NUMBER of clients with random name, surname, country and login date
http://localhost:8000/?random_name_count=1 - count all clients with random name or surname from ./web/publick/names_list.php or ./web/publick/surnames_list.php
http://localhost:8000/?random_country_count=1 - count all clients from random country from ./web/publick/country_list.php
http://localhost:8000/?login_from=UNIX_YIME_STAMP - count all clients with last login date > UNIX_YIME_STAMP 
http://localhost:8000/?all_records_count=1 - count all clients in DB
