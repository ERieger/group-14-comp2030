SET @@AUTOCOMMIT = 1;

DROP DATABASE IF EXISTS COMP2030_Group14_DB;
CREATE DATABASE COMP2030_Group14_DB;

USE COMP2030_Group14_DB;

CREATE TABLE factory_logs(
    machine_name varchar(100),
    operational_status varchar(100),
    time_stamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    temperature decimal(10, 2),
    pressure decimal(10, 2),
    vibration decimal(10, 2),
    humidity decimal(10, 2),
    error_code varchar(100),
    power_consumption decimal(10, 2),
    production_count decimal(10, 2),
    maintenance_log varchar(100),
    speed decimal(10, 2)
) 

CREATE user IF NOT EXISTS dbadmin@localhost;
GRANT all privileges ON COMP2030_Group14_DB.factory_logs TO dbadmin@localhost;


INSERT INTO factory_logs(machine_name) VALUES('CNC Machine
')
INSERT INTO factory_logs(operational_status) VALUES('active
')
INSERT INTO factory_logs(time_stamp) VALUES(1/04/2024 0:00
)
INSERT INTO factory_logs(temperature) VALUES(7)
INSERT INTO factory_logs(pressure) VALUES(7.89)
INSERT INTO factory_logs(vibration) VALUES(30)
INSERT INTO factory_logs(humidity) VALUES(78)
INSERT INTO factory_logs(error_code) VALUES('E306
')
INSERT INTO factory_logs(power_consumption) VALUES(25.45)
INSERT INTO factory_logs(production_count) VALUES(10)
INSERT INTO factory_logs(maintenance_log) VALUES('had a problem, is now fixed')
INSERT INTO factory_logs(speed) VALUES(99.99)
