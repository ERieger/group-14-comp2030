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

cursor.execute("SELECT DISTINCT machine_name FROM logs")

result = cursor.fetchall()

for x in result:
#   x = ''.join(x)
  print(x)
  
  sql = "INSERT INTO machines (machine_name) VALUES (%s)"
  cursor.execute(sql, x)
  db.commit()
  print(cursor.rowcount, "record inserted.")
  

