-- SHOW TABLES
SHOW COLUMNS FROM bookings
-- ALTER TABLE bookings MODIFY staff_id VARCHAR(20);
-- 

-- ALTER TABLE staff_service
-- ADD staff_name VARCHAR(100) NOT NULL,
-- ADD service_name VARCHAR(100) NOT NULL;


-- CREATE TABLE staff_service (
--     staff_id VARCHAR(20),
--     service_id INT,
--     PRIMARY KEY (staff_id, service_id),
--     FOREIGN KEY (staff_id) REFERENCES customer(user_id),
--     FOREIGN KEY (service_id) REFERENCES services(id)
-- );
-- INSERT INTO staff_service (staff_id, service_id) VALUES ('574077886', 1); -- Staff for haircuts
-- INSERT INTO staff_service (staff_id, service_id) VALUES ('5005296944', 2); -- Staff for manicure


-- CREATE TABLE staff (
--     id INT(11) AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     email VARCHAR(255) NOT NULL UNIQUE,
--     phone VARCHAR(20),
--     position VARCHAR(100),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );


-- SELECT * FROM customer

-- ALTER TABLE users
-- DROP COLUMN login_attempts INT DEFAULT 0,
-- DROP COLUMN lockout_until DATETIME NULL;
-- ALTER TABLE users
-- DROP COLUMN login_attempts,
-- DROP COLUMN lockout_until;
-- ALTER TABLE customer 
-- ADD COLUMN lockout_until DATETIME NULL;


-- ALTER TABLE bookings CHANGE customer_name user_name VARCHAR(255) NOT NULL;

-- SHOW COLUMNS FROM customer
-- ALTER TABLE bookings MODIFY booking_time VARCHAR(20) NOT NULL DEFAULT 'Not Specified';



-- ALTER TABLE bookings DROP COLUMN booking_time;
-- 



-- ALTER TABLE customer MODIFY password VARCHAR(255);

-- DESCRIBE customer;

-- select * from customer;


-- CREATE TABLE password_resets (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     user_id VARCHAR(255) NOT NULL,
--     token VARCHAR(255) NOT NULL,
--     expire DATETIME NOT NULL
-- );
-- SHOW TABLES;

-- select* from password_resets;

-- describe password_resets

-- DROP TABLE IF EXISTS password_resets;

-- CREATE TABLE password_resets (
--     email VARCHAR(100) NOT NULL,
--     token VARCHAR(255) NOT NULL,
--     expires_at DATETIME NOT NULL,
--     PRIMARY KEY (token)
-- -- );

-- SHOW TABLES;

-- DESCRIBE password_resets;

-- DESCRIBE bookings;

-- DESCRIBE services

-- CREATE TABLE users (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     username VARCHAR(100) NOT NULL,
--     password VARCHAR(255) NOT NULL,
--     2fa_secret VARCHAR(255) NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
-- );

-- SELECT * from users

-- DESCRIBE users

-- ALTER TABLE customer ADD COLUMN 2fa_secret VARCHAR(255) AFTER email;
-- ALTER TABLE customer CHANGE `2fa_secret` `two_fa_secret` VARCHAR(255) NOT NULL;

-- SHOW COLUMNS FROM bookings

-- ALTER TABLE customer 
-- CHANGE `2fa_secret` `two_fa_secret` VARCHAR(255) NOT NULL;



-- SELECT* FROM customer

-- ALTER TABLE services 
-- ADD COLUMN duration INT NOT NULL; -- Duration in minutes


-- ALTER TABLE bookings 
-- ADD COLUMN staff_id INT NOT NULL, -- ID of the staff member
-- ADD COLUMN booking_time DATETIME NOT NULL, -- Specific time for the booking
-- ADD COLUMN status ENUM('Pending', 'Confirmed', 'Cancelled') DEFAULT 'Pending', -- Booking status
-- ADD COLUMN payment_status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending', -- Payment status
-- ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP; -- Timestamp for when booking was created

-- CREATE TABLE staff (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     name VARCHAR(255) NOT NULL,
--     service_id INT NOT NULL,
--     FOREIGN KEY (service_id) REFERENCES services(id),
--     available_slots INT NOT NULL -- This can help manage availability
-- );

-- CREATE TABLE payments (
--     id INT AUTO_INCREMENT PRIMARY KEY,
--     booking_id INT NOT NULL,
--     amount DECIMAL(10, 2) NOT NULL,
--     payment_status ENUM('Pending', 'Completed', 'Failed') DEFAULT 'Pending',
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (booking_id) REFERENCES bookings(id)
-- );


-- DELIMITER //

-- CREATE PROCEDURE add_random_staff(IN num INT)
-- BEGIN
--     DECLARE i INT DEFAULT 0;
--     DECLARE random_name VARCHAR(255);
--     DECLARE random_email VARCHAR(255);
--     DECLARE random_phone VARCHAR(20);
--     DECLARE position VARCHAR(100) DEFAULT 'Staff Member';

--     WHILE i < num DO
--         SET random_name = CONCAT(
--             ELT(FLOOR(1 + RAND() * 10), 'John', 'Jane', 'Alice', 'Bob', 'Charlie', 'Daisy', 'Eve', 'Frank', 'Grace', 'Hannah'), 
--             ' ', 
--             ELT(FLOOR(1 + RAND() * 10), 'Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis', 'Miller', 'Wilson', 'Moore', 'Taylor')
--         );

--         SET random_email = CONCAT(
--             LOWER(REPLACE(random_name, ' ', '.')), 
--             '@', 
--             ELT(FLOOR(1 + RAND() * 3), 'example.com', 'test.com', 'demo.com')
--         );

--         SET random_phone = CONCAT('+254', FLOOR(700000000 + RAND() * 100000000));

--         INSERT INTO staff (name, email, phone, position) VALUES (random_name, random_email, random_phone, position);
--         SET i = i + 1;
--     END WHILE;
-- END //

-- DELIMITER ;

-- SELECT * FROM staff;

-- 


-- DROP TABLE staff;

-- INSERT INTO staff (name, email, phone, position) VALUES 
-- ('John Smith', 'john.smith@example.com', '+254700111222', 'Manager'),
-- ('Jane Doe', 'jane.doe@example.com', '+254700223344', 'Receptionist'),
-- ('Alice Johnson', 'alice.johnson@example.com', '+254700334455', 'Stylist'),
-- ('Bob Brown', 'bob.brown@example.com', '+254700445566', 'Technician'),
-- ('Charlie Davis', 'charlie.davis@example.com', '+254700556677', 'Cleaner'),
-- ('Daisy Wilson', 'daisy.wilson@example.com', '+254700667788', 'Stylist'),
-- ('Eve Moore', 'eve.moore@example.com', '+254700778899', 'Receptionist'),
-- ('Frank Miller', 'frank.miller@example.com', '+254700889900', 'Manager'),
-- ('Grace Taylor', 'grace.taylor@example.com', '+254700990011', 'Technician'),
-- ('Hannah White', 'hannah.white@example.com', '+254701001122', 'Cleaner');









