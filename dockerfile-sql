FROM mysql:5.7

# Set environment variables for MySQL
ENV MYSQL_ROOT_PASSWORD=${MYSQL_ROOT_PASSWORD}
ENV MYSQL_DATABASE=${MYSQL_DATABASE}
ENV MYSQL_USER=${MYSQL_USER}
ENV MYSQL_PASSWORD=${MYSQL_PASSWORD}

# Copy the SQL initialization script and shell script into the container
COPY ./db/localhost.sql /docker-entrypoint-initdb.d/
COPY ./db/check-and-init-db.sh /docker-entrypoint-initdb.d/

# Make sure the shell script is executable
RUN chmod +x /docker-entrypoint-initdb.d/check-and-init-db.sh
