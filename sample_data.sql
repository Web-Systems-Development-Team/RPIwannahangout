USE RPIWannaHangOut;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

INSERT INTO `user` VALUES
(1, 'powatm', 'Mary', 'Powathil', 'powatm@rpi.edu', 1000),
(2, 'pelisa', 'Aidan', 'Pelisson', 'pelisa@rpi.edu', 1000),
(3, 'rootc2', 'Cameron', 'Root', 'rootc2@rpi.edu', 1000),
(4, 'llewem', 'Max', 'Llewellyn', 'llewem@rpi.edu', 1000);

INSERT INTO `event` VALUES
(1, 'Group Pizza Party', '2014-12-04 18:00:00', '2014-12-04 19:00:00', 'Lally 104', 'A (fake) pizza party for the members of the RPIWannaHangout development team. Immediately after presentations on the last day of class.', 0, 2),
(2, 'Totally Not Fake Black Friday Shopping Trip', '2014-11-28 10:00:00', '2014-11-28 18:00:00', 'Meet at Freshman Circle', '*************************\r\nEveryone on campus over Thanksgiving, let''s go to Albany to do some Black Friday shopping!\r\n*************************', 1, 4),
(3, 'I need someone to play Mario Kart with', '2014-11-20 09:00:00', '2014-11-20 12:00:00', 'Blitman 1310', 'I have a Wii and a copy of Mario Kart and the CPU opponents are predictable and boring. Someone come race against me.', 0, 3);

INSERT INTO `event_interest` VALUES
(1, 0, 1, 1),
(2, 0, 2, 1),
(3, 0, 3, 1),
(4, 0, 4, 1),
(5, 0, 1, 2),
(6, 0, 2, 3);

INSERT INTO `comment` VALUES
(1, 'comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment comment', '2014-11-20 00:00:00', '2014-11-20 00:00:00', 2, 1),
(3, 'djfjawoebvoain3oinwclqienniqncwjebfqjwbevoiebvnjwqboqjev lkqwjenoq2ienvvwqehfnjq2env', '2014-11-17 00:00:00', '2014-11-19 08:00:00', 4, 2);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
