SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone= "+00:00";

CREATE DATABASE IF NOT EXISTS `CodeAndPunch` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `CodeAndPunch`;
CREATE TABLE `users`(
    `id` INT(250) NOT NULL AUTO_INCREMENT,
    `username` varchar(250) CHARACTER SET utf8 NOT NULL,
    `password` varchar(250) CHARACTER SET utf8 NOT NULL,
    `role` varchar(250) CHARACTER SET utf8 NOT NULL,
    `name` varchar(250) CHARACTER SET utf8 NOT NULL,
    `email` varchar(250) CHARACTER SET utf8 NOT NULL,
    `phone_number` INT(20) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`, `role`, `name`, `email`, `phone_number`) VALUES
('0', 'QuanNH', 'Quan520999', 'teacher', 'Quân','quannhhe181611@fpt.edu.vn','0338774401'),
('1', 'HuyDM','Huy129222', 'student', 'Huy','huydmhe171027@fpt.edu.vn','0582189459'),
('2', 'Student1', 'studen0386113', 'student', 'student1','student123456@fpt.edu.vn','0123456789');


CREATE TABLE challenge (
    `file_id` INT(11) PRIMARY KEY AUTO_INCREMENT,
    `challenge_name` VARCHAR(255) NOT NULL,
    `description` TEXT,
    `answer` VARCHAR(255),
    `deadline` DATETIME,
    `file_path` VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
