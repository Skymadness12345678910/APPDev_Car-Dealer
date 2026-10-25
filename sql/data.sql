DROP DATABASE IF EXISTS car_dealing_db;
CREATE DATABASE car_dealing_db;
USE car_dealing_db;

-- PARENT TABLE
CREATE TABLE brands (
    brand_id INT AUTO_INCREMENT PRIMARY KEY,
    brand_name VARCHAR(50) NOT NULL,
    country VARCHAR(50) NOT NULL,
    founded_year INT NOT NULL,
    headquarters VARCHAR(100) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- CHILD TABLE
CREATE TABLE car_models (
    model_id INT AUTO_INCREMENT PRIMARY KEY,
    model_name VARCHAR(50) NOT NULL,
    body_type VARCHAR(30) NOT NULL,
    year_model INT NOT NULL,
    color VARCHAR(30) NOT NULL,
    transmission VARCHAR(20) NOT NULL,
    fuel_type VARCHAR(20) NOT NULL,
    seating_capacity INT NOT NULL,
    price DECIMAL(12,2) NOT NULL,
    stock INT NOT NULL DEFAULT 0,
    brand_id INT NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (brand_id) REFERENCES brands(brand_id)
);

-- OPTIONAL SAMPLE DATA
INSERT INTO brands (brand_name, country, founded_year, headquarters) VALUES
('Toyota', 'Japan', 1937, 'Toyota City, Aichi'),
('Honda', 'Japan', 1948, 'Minato, Tokyo');

INSERT INTO car_models (model_name, body_type, year_model, color, transmission, fuel_type, seating_capacity, price, stock, brand_id) VALUES
('Vios', 'Sedan', 2024, 'White', 'Automatic', 'Gasoline', 5, 850000.00, 5, 1),
('Fortuner', 'SUV', 2024, 'Black', 'Automatic', 'Diesel', 7, 1800000.00, 3, 1),
('Civic', 'Sedan', 2024, 'Gray', 'Automatic', 'Gasoline', 5, 1500000.00, 4, 2);