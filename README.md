# REST web services example
This is example will help you to create Rest based web services, which fetch data from Mysql database.

##Database setup:
-	Create Database and import sql file (db_company_rest_services.sql)

##How to Host:
-	Move all file and folder in root directory 
-	Database configuration: system/dbclass.php

##Web services Details:
**1.	Get Company List:**
	Url : http://www.xyz.com/api/getCompanies
	Response: Json Array
		-	ComapnyID
		-	Name
		-	Address
		-	City
		-	Country
		-	Email 
		-	Phone

**2.	Get Company Detail**
	Url : http://www.xyz.com/api/getCompany (POST)
	Post Field:
	-	ComapnyID
	Response: Json Array
		-	ComapnyID
		-	Name
		-	Address
		-	City
		-	Country
		-	Email 
		-	Phone
		-	Directors (Array)

**3.	Add Company**
	Url : http://www.xyz.com/api/createCompany (POST)
	Post Field:
		-	Name
		-	Address
		-	City
		-	Country
		-	Email 
		-	Phone
		-	Directors (Array)
	Response : Json Array
		-	Success  (1 or 0)

**4.	Update Company**
	Url : http://www.xyz.com/api/updateCompany (POST)
	Post Field:
		-	CompanyID
		-	Name
		-	Address
		-	City
		-	Country
		-	Email 
		-	Phone
		-	Directors (Array)
	Response : Json Array
		-	Success  (1 or 0)

**5.	Delete Company**
	Url : http://www.xyz.com/api/updateCompany (POST)
	Post Field:
		-	CompanyID		
	Response : Json Array
		-	Success  (1 or 0)