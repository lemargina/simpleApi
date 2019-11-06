Use sqls.sql to create database, and make users table.

Use read.php to see all records from users table
Use create.php like this to create new record in database  domainname/create.php

Same for update, delete , read(show all the records from database), while read_one.php?id=1 will return the user with id=1

The main object is User.php and it is located in object folder.The methods(create,update,delete) are in user folder

Utils folder hold the dbconnect file

I have used POSTMAN  for API calls and more specific for create and delete.