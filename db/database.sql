-- Online Exam Monitoring System Database Schema
-- Create database
CREATE DATABASE IF NOT EXISTS exam_monitoring_system;
USE exam_monitoring_system;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Questions table
CREATE TABLE IF NOT EXISTS questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question_text TEXT NOT NULL,
    option_a VARCHAR(255) NOT NULL,
    option_b VARCHAR(255) NOT NULL,
    option_c VARCHAR(255) NOT NULL,
    option_d VARCHAR(255) NOT NULL,
    correct_option ENUM('a', 'b', 'c', 'd') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Results table
CREATE TABLE IF NOT EXISTS results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score INT NOT NULL DEFAULT 0,
    total_questions INT NOT NULL DEFAULT 0,
    time_taken INT NOT NULL DEFAULT 0,
    status ENUM('completed', 'cheated') NOT NULL DEFAULT 'completed',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample questions
INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option) VALUES
('What does HTML stand for?', 'HyperText Markup Language', 'High Tech Modern Language', 'Home Tool Markup Language', 'Hyperlink and Text Markup Language', 'a'),
('Which CSS property is used to change the text color?', 'font-color', 'text-color', 'color', 'text-style', 'c'),
('What is the correct way to declare a JavaScript variable?', 'var name = "John";', 'variable name = "John";', 'v name = "John";', 'var = "John";', 'a'),
('Which method is used to add an element to the end of an array in JavaScript?', 'push()', 'append()', 'add()', 'insert()', 'a'),
('What does PHP stand for?', 'Personal Home Page', 'PHP: Hypertext Preprocessor', 'Private Home Page', 'Programmed Hypertext Processor', 'b'),
('Which SQL statement is used to extract data from a database?', 'EXTRACT', 'SELECT', 'GET', 'OPEN', 'b'),
('What is the default method for HTML forms?', 'GET', 'POST', 'PUT', 'DELETE', 'a'),
('Which HTML tag is used to define an internal stylesheet?', '<style>', '<css>', '<script>', '<link>', 'a'),
('What is the correct syntax for referring to an external script called "script.js"?', '<script href="script.js">', '<script name="script.js">', '<script src="script.js">', '<script file="script.js">', 'c'),
('Which property is used to change the background color?', 'bgcolor', 'background-color', 'color-background', 'background', 'b');

