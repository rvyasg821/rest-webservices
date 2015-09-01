# RESTful Web Service Demonstration
The example code demonstrates how to create, configure and consume a RESTful web service backed by MySQL database using PHP.

##Database Setup:
- Creates Database and required schema (db_company_rest_services.sql)

##How to Host:
- Move all files and folders in root directory 
- Database configuration: system/dbclass.php

##RESTful Web service Details:
**1. Get Company List:**

Example Url : http://www.xyz.com/api/getCompanies

Response: Json Array
- ComapnyID
- Name
- Address
- City
- Country
- Email 
- Phone

**2. Get Company Detail**

Example Url : http://www.xyz.com/api/getCompany (POST)

Post Field:
- ComapnyID

Response: Json Array
- ComapnyID
- Name
- Address
- City
- Country
- Email 
- Phone
- Directors (Array)

**3. Add Company**

Example Url: http://www.xyz.com/api/createCompany (POST)

Post Field:
- Name
- Address
- City
- Country
- Email 
- Phone
- Directors (Array)

Response: Json Array
- Success  (1 or 0)

**4. Update Company**

Example Url: http://www.xyz.com/api/updateCompany (POST)

Post Field:
- CompanyID
- Name
- Address
- City
- Country
- Email 
- Phone
- Directors (Array)

Response: Json Array
- Success  (1 or 0)

**5. Delete Company**

Example Url: http://www.xyz.com/api/deleteCompany (POST)

Post Field:
- CompanyID		

Response: Json Array
- Success  (1 or 0)

