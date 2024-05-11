-- Create database
CREATE DATABASE IF NOT EXISTS JDShop;

-- Use the database
USE JDShop;

-- Create customers table
CREATE TABLE IF NOT EXISTS customers (
    customerID INT AUTO_INCREMENT PRIMARY KEY,
    customerUserName VARCHAR(50) NOT NULL UNIQUE,
    customerPassword VARCHAR(255) NOT NULL,
    customerEmail VARCHAR(100) NOT NULL,
    customerPhone BIGINT,
    customerFirstName VARCHAR(50),
    customerLastName VARCHAR(50),
    customerStreetAddress1 VARCHAR(100),
    customerStreetAddress2 VARCHAR(100),
    customerStreetAddress3 VARCHAR(100),
    customerPostcode INT,
    customerTown VARCHAR(50),
    customerState VARCHAR(50),
    customerStatus INT DEFAULT 1,
    customerMembership INT DEFAULT 0
);

-- Create products table
CREATE TABLE IF NOT EXISTS products (
    productID INT AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(100) NOT NULL,
    productDescription TEXT,
    productCategory VARCHAR(50),
    productSize INT,
    productCurrentStock INT DEFAULT 0,
    productStatus INT DEFAULT 1
);

-- Create orders table
CREATE TABLE IF NOT EXISTS orders (
    orderID INT AUTO_INCREMENT PRIMARY KEY,
    customerID INT,
    orderReferenceNo INT,
    totalPrice DOUBLE,
    orderStatus INT DEFAULT 0,
    FOREIGN KEY (customerID) REFERENCES customers(customerID)
);

-- Create orderedProducts table
CREATE TABLE IF NOT EXISTS orderedProducts (
    orderReferenceNo INT,
    productID INT,
    Quantity INT,
    price DOUBLE,
    FOREIGN KEY (orderReferenceNo) REFERENCES orders(orderID),
    FOREIGN KEY (productID) REFERENCES products(productID)
);

-- Create staff table
CREATE TABLE IF NOT EXISTS staff (
    staffID INT AUTO_INCREMENT PRIMARY KEY,
    staffUserName VARCHAR(50) NOT NULL UNIQUE,
    staffPassword VARCHAR(255) NOT NULL,
    staffName VARCHAR(100),
    staffEmail VARCHAR(100),
    staffPhone BIGINT,
    staffAccessLevel INT DEFAULT 1
);

-- Insert admin entry into staff table
INSERT INTO staff (staffUserName, staffPassword, staffName, staffEmail, staffPhone, staffAccessLevel)
VALUES ('admin', 'adminpassword', 'Admin Name', 'admin@example.com', 1234567890, 1);
