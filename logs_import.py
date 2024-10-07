import os
import csv
from dotenv import load_dotenv
from pathlib import Path
from datetime import datetime
import mysql.connector

# Load environment variables from .env file
load_dotenv(Path('./.env'))

# Print the database hostname for debugging
print(f"Connecting to: {os.getenv('DB_HOSTNAME')}")

# Connect to the MySQL database using environment variables
db = mysql.connector.connect(
    host=os.getenv('DB_HOSTNAME'),
    user=os.getenv('DB_USERNAME'),
    password=os.getenv('DB_PASSWORD'),
    database=os.getenv('DB_DATABASE')
)

cursor = db.cursor()
counter = 0

# SQL INSERT statement with placeholders for each column
sql = """INSERT INTO logs 
        (`timestamp`, machine_name, temperature, pressure, vibration, humidity, 
         power_consumption, status, error_code, production, maintenance_log, speed) 
        VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"""

# Open the CSV file and start reading it
with open('./factory_logs.csv', mode='r') as file:
    csv_reader = csv.reader(file)
    header = next(csv_reader)  # Skip the header row
    print(f'Header: {header}')
    
    # Loop through each row in the CSV
    for row in csv_reader:
        try:
            # Convert the 'timestamp' column (first column in the row) to MySQL DATETIME format
            row[0] = datetime.strptime(row[0], '%d/%m/%Y %H:%M').strftime('%Y-%m-%d %H:%M:%S')
            
            # Replace empty values with appropriate defaults
            row[1] = row[1] if row[1] else 'Unknown'  # machine_name - default value
            row[2] = float(row[2]) if row[2] else 0.0  # temperature - default to 0.0
            row[3] = float(row[3]) if row[3] else 0.0  # pressure - default to 0.0
            row[4] = float(row[4]) if row[4] else 0.0  # vibration - default to 0.0
            row[5] = float(row[5]) if row[5] else 0.0  # humidity - default to 0.0
            row[6] = float(row[6]) if row[6] else 0.0  # power_consumption - default to 0.0
            row[7] = row[7] if row[7] else 'Unknown'  # status - default value
            row[8] = int(row[8]) if row[8] and row[8].isdigit() else 0  # error_code
            row[9] = int(row[9]) if row[9] else 0  # production - default to 0
            row[10] = row[10] if row[10] else 'No Log'  # maintenance_log - default value
            row[11] = float(row[11]) if row[11] else 0.0  # speed - default to 0.0

            # Execute the SQL INSERT command for each row
            cursor.execute(sql, row)
            db.commit()
            counter += 1  # Increment the counter after successful insertion
            print(f"{cursor.rowcount} Record inserted. Current total: {counter}")
        
        except mysql.connector.Error as err:
            # Handle potential MySQL errors and log them
            print(f"Error inserting row: {err}")
            db.rollback()  # Roll back the transaction in case of an error
        
        except ValueError as e:
            # Handle issues like date conversion errors or casting errors
            print(f"Error processing row {row}: {e}")
            continue

# Close the cursor and the database connection
cursor.close()
db.close()

print(f"Total records inserted: {counter}")
