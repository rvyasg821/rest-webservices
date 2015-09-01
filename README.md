# REST web services example
This is example will help you to create Rest based web services, which fetch data from Mysql database.

##Database setup:
- Create Database and import sql file (db_company_rest_services.sql)

##How to Host:
- Move all file and folder in root directory 
- Database configuration: system/dbclass.php

##Web services Details:
**1. Get Company List:**

Url : http://www.xyz.com/api/getCompanies

Response: Json Array
- ComapnyID
- Name
- Address
- City
- Country
- Email 
- Phone

