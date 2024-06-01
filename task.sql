
CREATE DATABASE task;

CREATE TABLE `customers` (
  `customer_id` int(10) PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `firstname` varchar(20) DEFAULT NULL,
  `lastname` varchar(20) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `role` ENUM('user', 'admin') DEFAULT 'user',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updaupdated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



CREATE TABLE `results` (
  `result_id` int(10)PRIMARY KEY AUTO_INCREMENT NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `score_type` varchar(20) DEFAULT NULL,
  `display_data` varchar(20) DEFAULT NULL,
  FOREIGN KEY (customer_id) REFERENCES customers(customer_id),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updaupdated_at  TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `customers` (`customer_id`, `firstname`, `lastname`, `email`, `phone`, `role`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', '0544800863', 'admin'),
(2, 'Md Naimul', 'Alam', 'naimul@gmail.com', '01811889072', 'user'),
(3, 'Naimul', 'Alam', 'naimul@gmail.com', '01811889072', 'user'),
(4, 'Sayeda ', 'Reshma', 'reshma@gmail.com', '01811889072', 'user'),
(5, 'nahidul ', 'alam', 'naimul@gmail.com', '01811889072', 'user');