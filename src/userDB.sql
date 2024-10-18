SET @@AUTOCOMMIT = 1;


USE practical3;

CREATE TABLE users(
    id int(5) NOT NULL AUTO_INCREMENT,
    fName varchar(20),
    lName varchar(20),
    role varchar(20),
    phoneNumber varchar(10),
    gender varchar(10),
    PRIMARY KEY (id)
   )
--    add in after 
   CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON practical3.users TO dbadmin@localhost;

