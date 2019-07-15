CREATE DATABASE IF NOT EXISTS `user`;

CREATE TABLE IF NOT EXISTS `user` (
    `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `username` varchar(255) NOT NULL DEFAULT '',
    `password` varchar(255) NOT NULL DEFAULT '',
    `firstname` varchar(255) NOT NULL DEFAULT '',
    `lastname` varchar(255) NOT NULL DEFAULT '',
    `email` varchar(255) NOT NULL DEFAULT '',
    `description` text,
    `image` varchar(255) NOT NULL DEFAULT '',
    `created_at` timestamp
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

