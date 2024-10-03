SET @@AUTOCOMMIT = 1;


USE practical3;

CREATE TABLE users(
    id int(5),
    fName varchar(20),
    lName varchar(20),
    role varchar(20)
   )
   
   CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON practical3.users TO dbadmin@localhost;

INSERT INTO users(id) VALUES(1);
INSERT INTO users(fName) VALUES("John");
INSERT INTO users(lName) VALUES("Smith");
INSERT INTO users(role) VALUES("auditor");