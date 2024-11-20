#!/bin/bash

# Wait for MySQL to start up (if needed)
sleep 10

# Check if the 'parlour' database exists
DB_EXISTS=$(mysql -u root -p$MYSQL_ROOT_PASSWORD -e "SHOW DATABASES LIKE '$MYSQL_DATABASE';")

if [[ -z "$DB_EXISTS" ]]; then
    echo "Database '$MYSQL_DATABASE' does not exist, creating it now..."
    mysql -u root -p$MYSQL_ROOT_PASSWORD -e "CREATE DATABASE $MYSQL_DATABASE;"
else
    echo "Database '$MYSQL_DATABASE' already exists."
fi

# Check if any tables exist in the 'parlour' database
TABLES_EXIST=$(mysql -u root -p$MYSQL_ROOT_PASSWORD -e "USE $MYSQL_DATABASE; SHOW TABLES;")

if [[ -z "$TABLES_EXIST" ]]; then
    echo "No tables found in '$MYSQL_DATABASE', initializing database with localhost.sql..."
    mysql -u root -p$MYSQL_ROOT_PASSWORD $MYSQL_DATABASE < /docker-entrypoint-initdb.d/localhost.sql
else
    echo "Tables already exist in '$MYSQL_DATABASE'."
fi

# End of script
exit 0
