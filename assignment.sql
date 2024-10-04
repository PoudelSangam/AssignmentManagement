-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 04, 2024 at 11:54 AM
-- Server version: 10.6.18-MariaDB
-- PHP Version: 8.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `poudels2_assignment`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignmentlist`
--

CREATE TABLE `assignmentlist` (
  `id` int(11) NOT NULL,
  `time` date NOT NULL DEFAULT current_timestamp(),
  `dead-line` date NOT NULL,
  `subject` varchar(50) NOT NULL,
  `assignment_question` longtext NOT NULL,
  `assignment_number` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `intake_year` varchar(5) NOT NULL,
  `faculty` varchar(5) NOT NULL,
  `college` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignmentlist`
--

INSERT INTO `assignmentlist` (`id`, `time`, `dead-line`, `subject`, `assignment_question`, `assignment_number`, `semester`, `intake_year`, `faculty`, `college`) VALUES
(11, '2024-06-10', '2024-06-11', 'Instrumentation', '\r\nChapter 1 \r\n1 question for 8 mark\r\n\r\nChapter 2 \r\n2 questions for 8 marks each\r\n\r\nChapter 3\r\n2 questions for 8 marks each', 1, 5, '078', 'bct', 'sagarmatha'),
(13, '2024-06-18', '2024-07-01', 'Probability', '<p style=\"text-align: justify;\">1. A box containing 5000 IC chips of which 1000 are manufactured by company A and the rest by company B. Ten percentage of the chips made by company A and five percentage of the chips by company B are defective.</p>\r\n<p style=\"text-align: justify;\">&nbsp;(a) If we select a chip at random, what is the probability that the chip chosen is defective?</p>\r\n<p style=\"text-align: justify;\">&nbsp;(b) If a randomly chosen chip is found to be defective, what is the probability that it comes from company A.</p>\r\n<p style=\"text-align: justify;\">2. In a particular city airport A handles 50% of all airline traffic, airport B handles 30% and airport C handles 20%. The detecting rate for weapons at the airports are 0.9, 0.5, and 0.4 respectively. A passenger is randomly selected at one of the airport.</p>\r\n<p style=\"text-align: justify;\">(a) What is the probability that he/she is carrying a weapon?</p>\r\n<p style=\"text-align: justify;\">&nbsp;(b) If he/she is found to be carrying a weapon, what is the probability that airport A is being used.</p>\r\n<p style=\"text-align: justify;\">3. A husband and wife appear in an interview for two vacancies in the same post. The probability of husband&rsquo;s selection is 1/5 and that of wife&rsquo;s selection is 1/7. What is the probability that</p>\r\n<p style=\"text-align: justify;\">(a) both of them will be selected.</p>\r\n<p style=\"text-align: justify;\">&nbsp;(b) only the husband will be selected.</p>\r\n<p style=\"text-align: justify;\">(c) only the wife will be selected.</p>\r\n<p style=\"text-align: justify;\">(d) only one of them will be selected.</p>\r\n<p style=\"text-align: justify;\">&nbsp;(e) at most one of them will be selected.</p>\r\n<p style=\"text-align: justify;\">(f) at least one of them will be selected.</p>\r\n<p style=\"text-align: justify;\">4. In an internal examination of a college, 30% of the students have failed in English, 20% of the students have failed in statistics, and 10% have failed in both subjects. If a student is selected at random and found to be failed in English, what is the probability that he already had failed in statistics?</p>\r\n<p style=\"text-align: justify;\">5. From 6 gentlemen and 4 ladies, a committee of five (5) is to be formed. Find the probability that</p>\r\n<p style=\"text-align: justify;\">(a) a committee should consist of 3 gentlemen and 2 ladies.</p>\r\n<p style=\"text-align: justify;\">&nbsp;(b) a committee should consist of all gentlemen.</p>\r\n<p style=\"text-align: justify;\">(c) a committee should consist of at least 3 ladies.</p>\r\n<p style=\"text-align: justify;\">(d) a committee should consist of at most 2 ladies.</p>', 2, 5, '078', 'bct', 'sagarmatha'),
(17, '2024-06-24', '2024-06-30', 'English', '<p>Report&nbsp;</p>', 1, 5, '078', 'bct', 'sagarmatha'),
(19, '2024-06-26', '2024-07-01', 'COA', '<p><strong>1. Explain the need of memory in computer system.</strong></p>\r\n<p><strong>2. Explain the characteristics of memory system.</strong></p>\r\n<p><strong>3. What are the parameters of memory hierarchy? Explain in detail.</strong></p>\r\n<p><strong>4. Explain ROM and RAM with its types in detail.</strong></p>\r\n<p><strong>5. Explain cache memory organization of cache. What is cache hit and cache miss?</strong></p>\r\n<p><strong>6. Explain different types of mapping techniques with necessary illustrations.</strong></p>\r\n<p><strong>7. Why is replacement algorithm not needed for direct mapping? Explain different types of </strong><strong>replacement algorithm for associative mapping.</strong></p>\r\n<p><strong>8. Explain write policy for cache. Also describe about</strong> <strong>different elements of cache design.</strong></p>\r\n<p><strong>9. Explain how you analyze the performance of cache memory?</strong></p>', 3, 5, '078', 'bct', 'sagarmatha'),
(20, '2024-06-26', '2024-07-03', 'English', '<p style=\"padding-left: 40px;\"><strong>Q.N.1.&nbsp; </strong><strong>Write a proposal to be submitted to the principal of your college on the improvement of the college library prepare only the executive summary part of the report.</strong><br><br></p>\r\n<p style=\"padding-left: 40px;\"><strong>Q.N.2. Write a proposal to be submitted to the principal of your college on the improvement of the college library prepare only the introduction part of the report.</strong></p>', 3, 5, '078', 'bct', 'sagarmatha'),
(26, '2024-06-28', '2024-07-17', 'Graphics', '<p>Q.no .1. Project submission and presentation for computer graphic&nbsp;</p>', 1, 5, '078', 'bct', 'sagarmatha'),
(53, '2024-07-01', '2024-07-14', 'English', '<p><strong>Technical Communication in English&nbsp;</strong></p>\r\n<p><em>(page.no-156)</em></p>\r\n<p><strong>Long Answer Question:<br><br></strong>1. Describe Pahom\'s growing greed of land.</p>\r\n<p>2. Describe Pahom\'s thoughts while he was racing for more land.</p>\r\n<p>3. How does the proverb \'an hour to suffer, a lifetime to live\' apply to Pahom\'s race for land.</p>\r\n<p>4.Describe an imaginary quarrel between two ladies- one from a village and other from a town-in present day Nepal.</p>\r\n<p>&nbsp;</p>', 3, 5, '078', 'bct', 'sagarmatha'),
(54, '2024-07-01', '2024-07-19', 'Graphics', '<p><strong>Blog Post</strong></p>\r\n<p>1. What will I utilize about Computer Graphics after I graduate.(<em>500 words)</em></p>\r\n<p>submit as a PDF document&nbsp;</p>\r\n<p><strong>Conditions&nbsp;</strong></p>\r\n<p><strong>1. No copied contents.</strong></p>\r\n<p><strong>2. Less than 5% plagiarism tolerated.</strong></p>\r\n<p><strong><em>Email-&nbsp;</em></strong><em>sushantbhattarai@hcoe.edu.np</em></p>', 3, 5, '078', 'bct', 'sagarmatha'),
(56, '2024-07-04', '2024-07-18', 'Software', '<p><strong>Que-&nbsp;Complete the given set of old question&nbsp;</strong><br><br></p>\r\n<table dir=\"ltr\" style=\"width: 54.8726%; border-collapse: collapse; border-spacing: 5px; height: 1237.7px; margin-left: auto; margin-right: auto; border: 2px solid #000000;\" border=\"1\" cellspacing=\"0\" cellpadding=\"0\" data-sheets-root=\"1\"><colgroup><col style=\"width: 14.2466%;\" width=\"37\"><col style=\"width: 32.3288%;\" width=\"141\"><col style=\"width: 24.6575%;\" width=\"123\"><col style=\"width: 29.0411%;\" width=\"99\"></colgroup>\r\n<tbody>\r\n<tr style=\"height: 41.3906px;\">\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\"><strong>S.No.</strong></td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\"><strong>Student Name</strong></td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" colspan=\"2\" data-sheets-value=\"{\"><strong>Old question year</strong></td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">1</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Aastha Jha</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Aayusha Bhattarai</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">3</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Aditya Dhital</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2072 Chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">4</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Alisha Chaudhary</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 kartik</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 bhadra</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">5</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Avishek Pageni</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">6</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Bhanu Bista</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">7</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Bishesh Gautam</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">8</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Bishwa Kandel</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">9</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Eliza Sharma</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Baisakh</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">10</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Nabin Ghimire</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Bhadra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">11</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Nikhil K.C.</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 baisakh</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">12</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Niranjan Bhatta</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2072 Chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 kartik</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">13</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Nischal Dangol</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 bhadra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">14</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Piyush Pant</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">15</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Prabhakar Kandel</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">16</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Prabin Bhusal</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">17</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Pushkar Jha</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 kartik</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">18</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Pushpa Baskota</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">19</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Rabi Chandra Aryal</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">20</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Rhythm Baral</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2072 Chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">21</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Rohisa Giri</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 bhadra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">22</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sachin Maharjan</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Baisakh</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">23</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sachin Subedi</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Bhadra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">24</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sadikshya Ghimire</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 Ashwin</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 baisakh</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">25</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Samita Gyawali</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2072 Chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 kartik</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">26</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sandesh K.C.</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 bhadra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">27</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sangam Poudel</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">28</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Shashank Katuwal</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2080 Bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2075 chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">29</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Sumesh Dhonju</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 baisakh</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 Ashwin</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">30</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Unnati Rijal</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 kartik</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2074 Chaitra</td>\r\n</tr>\r\n<tr style=\"height: 23.3906px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">31</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Yaman Adhikari</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2078 bhadra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2072 Chaitra</td>\r\n</tr>\r\n<tr style=\"height: 45.7812px;\">\r\n<td style=\"border-color: #000000; text-align: center; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">32</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">Shristee Maharjan</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2076 chaitra</td>\r\n<td style=\"border-color: #000000; border-width: 2px; padding: 5px;\" data-sheets-value=\"{\">2079 bhadra</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 5, '078', 'bct', 'sagarmatha'),
(57, '2024-07-04', '2024-07-08', 'Graphics', '<p><strong>Homework&nbsp;<br><br></strong><strong>Chapter-5&nbsp;</strong><br>write about&nbsp;<br>1.Hermite curve</p>\r\n<p>2. B-spline curve<br><br><strong>Chapter-6&nbsp;<br></strong>write about&nbsp;<br>1.Polygonal meshes</p>\r\n<p>2. Wireframe model</p>', 4, 5, '078', 'bct', 'sagarmatha'),
(81, '2024-09-19', '2024-09-22', 'Communication English', '<p>hello&nbsp;</p>', 123456, 5, '078', 'bct', 'sagarmatha'),
(82, '2024-09-19', '2024-09-20', 'Probability and Statistics', '<p>test 2</p>', 654321, 5, '078', 'bct', 'sagarmatha'),
(83, '2024-09-22', '2024-09-24', 'Data Communication', '<p>Testing&nbsp;</p>', 123459, 5, '078', 'bct', 'sagarmatha'),
(84, '2024-09-22', '2024-09-21', 'Instrumentation II', '<p>Tegsvs s jsvsgshhsvs&nbsp;</p>', 123987, 5, '078', 'bct', 'sagarmatha'),
(85, '2024-09-22', '2024-09-24', 'Instrumentation II', '<p>Ghdvshsusvshsi hsjsbsb jsj</p>', 369, 5, '078', 'bct', 'sagarmatha'),
(86, '2024-09-22', '2024-09-30', 'Data Communication', '<p><strong>hello&nbsp;</strong></p>', 23, 5, '078', 'bct', 'sagarmatha'),
(87, '2024-09-22', '2024-09-15', 'Computer Graphics', '<p>Yy</p>', 3, 5, '078', 'bct', 'sagarmatha'),
(88, '2024-09-23', '2024-09-25', 'Communication English', '<p>hello</p>', 12, 5, '078', 'bct', 'sagarmatha'),
(89, '2024-09-23', '2024-09-30', 'Communication English', '<p>bbbbb</p>', 123, 5, '078', 'bct', 'sagarmatha'),
(90, '2024-09-23', '2024-09-10', 'Computer Organization and Architecture', '<p>vghvvgvg&nbsp;</p>', 1, 5, '078', 'bct', 'sagarmatha'),
(91, '2024-09-23', '2024-09-25', 'Probability and Statistics', '<p>hbhbh</p>', 1, 5, '078', 'bct', 'sagarmatha'),
(92, '2024-09-23', '2024-09-25', 'Communication English', '<p>mmmm</p>', 21, 5, '078', 'bct', 'sagarmatha'),
(93, '2024-09-23', '2024-09-17', 'Probability and Statistics', '<p>nbnbnbnnb</p>', 31313, 5, '078', 'bct', 'sagarmatha'),
(94, '2024-09-23', '2024-09-19', 'Communication English', '<p>ftftftft</p>', 123, 5, '078', 'bct', 'sagarmatha'),
(95, '2024-09-23', '2024-09-19', 'Software Engineering', '<p>&nbsp;nbnbnn</p>', 22, 5, '078', 'bct', 'sagarmatha'),
(96, '2024-10-02', '2024-10-01', 'Communication English', '<p>asdadasdada</p>', 1212, 5, '078', 'bct', 'sagarmatha');

-- --------------------------------------------------------

--
-- Table structure for table `cr`
--

CREATE TABLE `cr` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gmail` varchar(50) NOT NULL,
  `phonenumber` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `password` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `title` varchar(100) NOT NULL,
  `pdf_name` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `semester`, `faculty`, `subject`, `title`, `pdf_name`, `description`) VALUES
(1, 'Semester 5', 'bct', 'Probability and Statistics', 'Insights on Probability and Statistics', 'Probability and Statistics.pdf', 'Chapter-wise important numerical problem'),
(2, 'Semester 5', 'bct', 'Computer Graphics', 'Insight', '1726228452_Insight-on-Computer-GraphicsCG.pdf', 'Insight-on-Computer-GraphicsCG'),
(7, 'Semester 5', 'bct', 'Communication English', 'Insight', '1726239509_Communication_English_Manual.pdf', 'Communication English Manual'),
(35, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 1- Microprocessor Based Instrument System', '1726376806_Chapter_1_-_Microprocessor_Based_Instrumentation_System_1680186108244.pdf', 'Chapter-1 lecture note on Instrumentation II by Hari Pd Aryal'),
(8, 'Semester 5', 'bct', 'Communication English', 'Handwritten ', '1726367259_ENGLISH_1680017806023.pdf', 'By kamal Bista'),
(9, 'Semester 5', 'bct', 'Communication English', 'Summary', '1726367441_ENGLISH_SUMMARY_1680018294917.pdf', 'Summary note on Communication English'),
(78, 'Semester 6', 'bct', 'Operating System', 'solutions to Old Question Set', '1727144675_ilovepdf_merged (1)_compressed.pdf', 'solutions to Old Question Set upto 2075'),
(11, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 1- Introduction', '1726368813_Chapter_1_-_Introduction_1680050874633.pdf', 'BY Hari Pd Aryal '),
(12, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 2- Central Processing Unit', '1726368860_Chapter_2_-_Central_Processing_Unit_1680050874633.pdf', 'BY Hari Pd Aryal '),
(13, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 3- Control Unit', '1726368895_Chapter_3_-_Control_Unit_1680050874633.pdf', 'BY Hari Pd Aryal '),
(14, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 4- Pipeline and Vector Processing', '1726368964_Chapter_4_-_Pipeline_and_Vector_processing_1680050874633.pdf', 'BY Hari Pd Aryal '),
(15, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 5- Computer Arithmetic ', '1726369004_Chapter_5_-_Computer_Arithmetic_1680050874633.pdf', 'BY Hari Pd Aryal '),
(16, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 6- Memory System', '1726369036_Chapter_6_-_Memory_System_1680050874633.pdf', 'BY Hari Pd Aryal '),
(17, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 7- Input Output Organization', '1726369083_Chapter_7_-_Input_Output_Organization_1680050874633.pdf', 'BY Hari Pd Aryal '),
(18, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'Chapter 8-Multiprocessor', '1726369114_Chapter_8_-_Multiprocessors_1680050874633.pdf', 'BY Hari Pd Aryal '),
(19, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'All Chapter Solution', '1726369194_ilovepdf_merged.pdf', 'All chapter question and answer'),
(20, 'Semester 5', 'bct', 'Software Engineering', 'Software Engineering Manual', '1726369895_Software_engineering_Manual_1680053101730 (1).pdf', 'Software Engineering Manual book'),
(21, 'Semester 5', 'bct', 'Software Engineering', 'Lecture Slide', '1726369988_Software_Engineering_(Compiled_by_SC_Sir)_1680053368889.pdf', 'Lecture Slides on Software Engineering by Dr. Sunil Chaudhary'),
(22, 'Semester 5', 'bct', 'Software Engineering', 'Lecture Slide', '1726370045_santos_giri_1694264875562.pdf', 'Chapterwise lecture slides on Software Engineering by Er. Santosh Giri '),
(23, 'Semester 5', 'bct', 'Computer Graphics', 'Lecture Slide', '1726370523_Graphics_Bishwas_1680055519904.pdf', 'Chapterwise lecture slides on Software Engineering by Er. Bishwas Pokhrel'),
(45, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 2- Parallel Interfacing With MBS', '1726377725_Chapter_2_-_Parallel_Interfacing_With_Microprocessor_Based_System_1680186108245.pdf', 'Chapter 2-lecture note on Instrumentation II by Hari Pd Aryal'),
(37, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 3- Serial Interfacing With MBS', '1726376902_Chapter_3_-_Serial_Interfacing_With_Microprocessor_Based_System_1680186108245.pdf', 'Chapter-3 lecture note on Instrumentation II by Hari Pd Aryal'),
(38, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 4- Interfacing AD and DA converter', '1726376962_Chapter_4_-_Interfacing_AD_and_DA_Converters_1680186108245.pdf', 'Chapter-4 lecture note on Instrumentation II by Hari Pd Aryal'),
(39, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 5- Data acquistion and transmission', '1726377011_Chapter_5_-_Data_Acquisition_and_Transmission_1680186108245.pdf', 'Chapter-5 lecture note on Instrumentation II by Hari Pd Aryal'),
(40, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 6- Grounding and shielding', '1726377054_Chapter_6_-_Grounding_and_Shielding_1680186108245.pdf', 'Chapter-6 lecture note on Instrumentation II by Hari Pd Aryal'),
(41, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 7- Circuit Design', '1726377112_Chapter_7_-_Circuit_Design_1680186108245.pdf', 'Chapter-7 lecture note on Instrumentation II by Hari Pd Aryal'),
(42, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 8- Circuit Layout', '1726377149_Chapter_8_-_Circuit_Layout_1680186108246.pdf', 'Chapter-8 lecture note on Instrumentation II by Hari Pd Aryal'),
(43, 'Semester 5', 'bct', 'Instrumentation II', 'Chapter 9- Software ', '1726377194_Chapter_9_-_Software_for_instrumentation_and_control_applications_1680186108246.pdf', 'Chapter-9 lecture note on Instrumentation II by Hari Pd Aryal'),
(81, 'Semester 6', 'bct', 'Embedded System', 'Handwritten Note', '1727146088_Embedded_Handwritten_1680227984725.pdf', 'Chapter-wise handwritten note on Embedded System\r\n\r\n\r\n'),
(47, 'Semester 5', 'bct', 'Data Communication', 'Handwritten Note', '1726382009_Data_Communication_1680188348719.pdf', 'Chapter-wise handwritten note on Data Communication'),
(48, 'Semester 5', 'bct', 'Data Communication', 'lecture note', '1726382042_DBK_Notes_1680187591109.pdf', 'Chapter-wise lecture note by Dinesh Baniya Kshatri\r\n\r\n\r\n'),
(76, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', 'Chapter-3 Object oriented design', '1727142453_Chapter_3_Object_Oriented_Design_1680195354909 (1).pdf', 'Lecture notes by Er. Hari Aryal'),
(51, 'Semester 2', 'bct', 'Engineering Chemistry', 'Handwritten Notes', '1726389429_Engineering_Chemistry_1679819286411.pdf', 'Complete handwritten note on Engineering Chemistry'),
(52, 'Semester 2', 'bct', 'Engineering Chemistry', 'Book', '1726389518_chemistry_book_1679819717604.pdf', 'A textbook of Engineering Chemistry'),
(80, 'Semester 6', 'bct', 'Embedded System', 'Insights on Embedded System', '1727145925_Embedded_System_Insights_1680227596392 (1)_compressed.pdf', 'file size is large so download it'),
(77, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', 'Chapter-4 Implementation', '1727142489_Chapter_4-_Implementatation_1680195354909 (1).pdf', 'Lecture notes by Er. Hari Aryal'),
(75, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', 'Chapter-2 Object oriented analysis', '1727142427_Chapter_2-_Object_Oriented_Analysis_1680195354909 (1).pdf', 'Lecture notes by Er. Hari Aryal'),
(79, 'Semester 6', 'bct', 'Operating System', 'Insights on Operating System', '1727145411_Operating_System_1680223640799 (1)_compressed.pdf', 'file size is large so download it'),
(74, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', 'Chapter-1 Introduction', '1727142370_Chapter_1__Introduction_1680195354909 (1).pdf', 'Lecture notes by Er. Hari Aryal'),
(70, 'Semester 6', 'bct', 'Engineering Economics', 'Economics Insights', '1727140995_Economics_Manual_1680189128021 (1).pdf', 'Economics Manual'),
(71, 'Semester 6', 'bct', 'Engineering Economics', 'Textbook: Engineering Economics', '1727141487_Economics_SK_1680188876941_compressed.pdf', 'A textbook on Engineering economics by SK Shrestha\r\n\r\n\r\n'),
(72, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', ' Lecture Slides by Er. Santosh Giri', '1727142074_OOAD_FullNote_1680194698535 (1).pdf', 'Chapter-wise lecture slides on Object Oriented Analysis and Design by Er. Santosh Giri\r\n\r\n\r\n\r\n\r\n'),
(73, 'Semester 6', 'bct', 'Object Oriented Analysis and Design', 'Handwritten Note', '1727142141_OOAD_Handwritten_1680196454621.pdf', 'Handwritten lecture note on OOAD'),
(69, 'Semester 2', 'bct', 'Fundamentals of Thermodynamics & Heat Transfer', 'Chapter-wise lecture note', '1726898800_Chapterwise_Note_1679820335327.pdf', 'Complete chapter-wise lecture notes on Thermodynamics\r\n\r\n\r\n\r\n\r\n'),
(68, 'Semester 2', 'bct', 'Fundamentals of Thermodynamics & Heat Transfer', 'Textbook: Numerical Solutions', '1726898730_Thermo_Numerical_Solution_Final_1679820572237_compressed.pdf', 'Solutions to Fundamental of Thermodynamics and Heat Transfer\r\n\r\n\r\n'),
(67, 'Semester 2', 'bct', 'Fundamentals of Thermodynamics & Heat Transfer', 'Thermo Dynamics Numerical Solution', '1726898634_Thermodynamics-Important-Questions-SOLVED_1679821044358.pdf', 'Thermo Dynamics solution to important numerical problems by Er. S Neupane'),
(66, 'Semester 6', 'bct', 'Artificial Intelligence', 'Artificial Intelligence', 'AI_INSIGHTS_1680197198767 (1)_compressed.pdf', 'large data please download'),
(82, 'Semester 8', 'bct', 'Engineering Professional Practice', 'Lecture notes by Prof. Dr. Hari Krishna Shrestha', '1727146510_ilovepdf_merged (1).pdf', 'Chapterwise lecture note on Engineering Professional Practice by Prof Dr. Hari Krishna Shrestha. \r\n\r\n\r\n\r\n\r\n'),
(83, 'Semester 8', 'bct', 'Engineering Professional Practice', 'Chapter-wise summary note', '1727146603_EPP_notes_1679539892636.pdf', 'Summary note of each chapter covering all important topics. \r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(84, 'Semester 8', 'bct', 'Information Systems', 'Insights on Information System', '1727147055_Insights_on_Information_System_1679583333197_compressed.pdf', 'Insights on Information System by Er. Anku Jaiswal \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(85, 'Semester 8', 'bct', 'Information Systems', 'Lecture Slides on Information System', '1727147225_ilovepdf_merged (2).pdf', 'Chapter-wise lecture slides on Information System by Phuspa Thapa. \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(86, 'Semester 8', 'bct', 'Internet and Intranet', 'Lecture note by Jeevan Rai', '1727147671_ilovepdf_merged (1).pdf', 'Complete lecture notes on the Internet and Intranet by Er. Jeevan Rai \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(87, 'Semester 8', 'bct', 'Internet and Intranet', 'Insights on Internet & Intranet', '1727147983_Insights_on_Internet__1679621599087_compressed.pdf', 'Insights on Internet and Intranet with solutions to Questions of the previous exam by Er. Biplab Poudel and Er. Ashish Thapa\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(88, 'Semester 8', 'bct', 'Simulation and Modelling', 'Chapter-wise lecture slides', '1727148194_ilovepdf_merged (2).pdf', 'Chapter-wise complete lecture slides by Thapathali Campus professor on Simulation and Modeling\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(89, 'Semester 4', 'bct', 'Data Structure and Algorithm', 'Chapter-wise lecture slides', '1727148634_ilovepdf_merged (3).pdf', 'Chapter-wise complete lecture slides by sagarmatha Campus professor on DSA \r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n'),
(90, 'Semester 4', 'bct', 'Discrete Structure', 'Handwritten Note', '1727148713_DSÂ Note.pdf', 'All chapter note'),
(91, 'Semester 4', 'bct', 'Microprocessor', 'Class Lecture Note ', '1727149279_chapter 1(1)_merged.pdf', 'Class Note by  sagarmatha campus professor\r\n'),
(92, 'Semester 4', 'bct', 'Electrical Machine', 'Class Lecture slide', '1727149645_ilovepdf_merged (1).pdf', 'Class Note by  sagarmatha campus professor\r\n'),
(93, 'Semester 6', 'bct', 'Operating System', 'Insights on Operating System', '1727150987_Operating_System_1680223640799 (1)_compressed.pdf', 'file size is large so download it'),
(94, 'Semester 4', 'bct', 'Electrical Machine', 'Insights on Electrical Machine', '1727151515_KBT_Insights_on_EM_1679845742353.pdf', 'A textbook on Electrical Machine by Khagendra Bahadur Thapa\r\n\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `time`) VALUES
(7, 'Online Form : BE/BAR (New Course) I Year II Part (Regular) for 2081 Asoj/Kartik', '2024-09-20 05:21:19'),
(6, 'Exam Center: BE/BAR All Year II Part except Final Year (Backpaper) for 2081 Asoj', '2024-09-20 05:21:19'),
(5, 'Exam Center: BE/BAR I Year II Part (Regular) for 2081 Asoj/Kartik', '2024-09-20 05:21:19'),
(8, 'Routine: BE/BAR  I year II part (Regular) - 2081 Asoj-Kartik', '2024-09-20 05:21:19'),
(9, 'Result: BE IV year II & BAR V/II part backpaper exam held on 2081 Shrawan', '2024-09-24 01:15:03'),
(10, 'Result: BE/BAR I year I  part New Course  exam held on 2081 Baishakh', '2024-09-30 08:15:03'),
(23, 'Online Form : BE/BAR (New Course) I Year I Part (Back) for 2081 Kartik', '2024-10-02 08:22:51'),
(25, 'Routine: BE/BAR  (New Course) I year I part (Back) - 2081 Kartik', '2024-10-02 12:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `notifications` varchar(250) NOT NULL,
  `status` varchar(8) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `intake` varchar(11) NOT NULL,
  `faculty` varchar(5) NOT NULL,
  `semester` varchar(5) NOT NULL,
  `college` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `notifications`, `status`, `time`, `intake`, `faculty`, `semester`, `college`) VALUES
(8, 'Library books due reminder', 'unread', '2024-09-12 10:35:00', '2023', 'BCT', '1', 'Sagar College'),
(7, 'Internship opportunity available', 'unread', '2024-09-13 09:00:00', '2021', 'BCE', '6', 'Himalaya College'),
(6, 'New course materials uploaded', 'read', '2024-09-14 04:30:00', '2022', 'BEX', '4', 'Everest College'),
(5, 'Class cancellation for today', 'unread', '2024-09-15 02:15:00', '2023', 'BCT', '2', 'Sagar College'),
(4, 'Quiz results for Physics', 'read', '2024-09-16 06:45:00', '2021', 'BEX', '5', 'Everest College'),
(3, 'Meeting tomorrow at 10 AM', 'unread', '2024-09-17 04:15:00', '2022', 'BCE', '3', 'Himalaya College'),
(2, 'Exam schedule released', 'read', '2024-09-18 09:15:00', '2023', 'BCT', '1', 'Sagar College'),
(1, 'New assignment posted for Math', 'unread', '2024-09-19 03:45:00', '2023', 'BCT', '1', 'Sagar College'),
(9, 'Workshop on AI next week', 'read', '2024-09-11 05:15:00', '2023', 'BEX', '5', 'Everest College'),
(10, 'Holiday notice for Dashain', 'unread', '2024-09-10 04:00:00', '2022', 'BCT', '3', 'Sagar College'),
(11, 'New project guidelines released for BCT', 'unread', '2024-09-19 03:30:28', '078', 'bct', '5', 'sagarmatha'),
(12, 'Final exam timetable is available now', 'unread', '2024-09-19 03:30:47', '078', 'bct', '5', 'sagarmatha'),
(13, 'Mid-term results for Data Structures published', 'read', '2024-09-19 03:30:54', '078', 'bct', '5', 'sagarmatha'),
(14, 'Lab assignment for Microprocessors due next Monday', 'unread', '2024-09-19 03:31:00', '078', 'bct', '5', 'sagarmatha'),
(15, 'Assignment of Communication English is added. Deadline is 2024-09-23.', 'unread', '2024-09-19 04:03:00', '078', 'bct', '5', 'sagarmatha'),
(16, 'Assignment of Probability and Statistics is added. Deadline is 2024-09-20.', 'unread', '2024-09-19 04:13:10', '078', 'bct', '5', 'sagarmatha'),
(17, 'Deadline for sagarmatha is tomorrow', 'unread', '2024-09-19 05:59:47', '078', 'bct', '5', 'sagarmatha'),
(18, 'Deadline for Probability and Statistics is tomorrow', 'unread', '2024-09-19 06:05:41', '078', 'bct', '5', 'sagarmatha'),
(19, 'Deadline for Probability and Statistics is tomorrow', 'unread', '2024-09-19 06:06:48', '078', 'bct', '5', 'sagarmatha'),
(20, 'Deadline for Communication English is tomorrow', 'unread', '2024-09-21 03:24:09', '078', 'bct', '5', 'sagarmatha'),
(21, 'Assignment of Data Communication is added. Deadline is 2024-09-24.', 'unread', '2024-09-22 05:43:51', '078', 'bct', '5', 'sagarmatha'),
(22, 'Assignment of Instrumentation II is added. Deadline is 2024-09-21.', 'unread', '2024-09-22 10:30:49', '078', 'bct', '5', 'sagarmatha'),
(23, 'Assignment of Instrumentation II is added. Deadline is 2024-09-24.', 'unread', '2024-09-22 10:33:32', '078', 'bct', '5', 'sagarmatha'),
(24, 'Assignment of Data Communication is added. Deadline is 2024-09-30.', 'unread', '2024-09-22 10:40:46', '078', 'bct', '5', 'sagarmatha'),
(25, 'Assignment of Computer Graphics is added. Deadline is 2024-09-15.', 'unread', '2024-09-22 10:46:28', '078', 'bct', '5', 'sagarmatha'),
(26, 'Deadline for Data Communication is tomorrow', 'unread', '2024-09-23 01:04:45', '078', 'bct', '5', 'sagarmatha'),
(27, 'Deadline for Data Communication is tomorrow', 'unread', '2024-09-23 01:09:45', '078', 'bct', '5', 'sagarmatha'),
(28, 'Deadline for Instrumentation II is tomorrow', 'unread', '2024-09-23 01:09:46', '078', 'bct', '5', 'sagarmatha'),
(29, 'Deadline for Data Communication is tomorrow', 'unread', '2024-09-23 01:44:01', '078', 'bct', '5', 'sagarmatha'),
(30, 'Deadline for Instrumentation II is tomorrow', 'unread', '2024-09-23 01:44:03', '078', 'bct', '5', 'sagarmatha'),
(31, 'Assignment of Communication English is added. Deadline is 2024-09-25.', 'unread', '2024-09-23 01:54:11', '078', 'bct', '5', 'sagarmatha'),
(32, 'Assignment of Communication English is added. Deadline is 2024-09-30.', 'unread', '2024-09-23 02:05:01', '078', 'bct', '5', 'sagarmatha'),
(33, 'Assignment of Computer Organization and Architecture is added. Deadline is 2024-09-10.', 'unread', '2024-09-23 02:23:04', '078', 'bct', '5', 'sagarmatha'),
(34, 'Assignment of Probability and Statistics is added. Deadline is 2024-09-25.', 'unread', '2024-09-23 02:23:37', '078', 'bct', '5', 'sagarmatha'),
(35, 'Assignment of Communication English is added. Deadline is 2024-09-25.', 'unread', '2024-09-23 02:28:37', '078', 'bct', '5', 'sagarmatha'),
(36, 'Assignment of Probability and Statistics is added. Deadline is 2024-09-17.', 'unread', '2024-09-23 02:29:22', '078', 'bct', '5', 'sagarmatha'),
(37, 'Assignment of Communication English is added. Deadline is 2024-09-19.', 'unread', '2024-09-23 02:45:13', '078', 'bct', '5', 'sagarmatha'),
(38, 'Assignment of Software Engineering is added. Deadline is 2024-09-19.', 'unread', '2024-09-23 02:45:58', '078', 'bct', '5', 'sagarmatha'),
(39, 'Deadline for Communication English is tomorrow', 'unread', '2024-09-24 01:15:04', '078', 'bct', '5', 'sagarmatha'),
(40, 'Deadline for Probability and Statistics is tomorrow', 'unread', '2024-09-24 01:15:10', '078', 'bct', '5', 'sagarmatha'),
(41, 'Deadline for Data Communication is tomorrow', 'unread', '2024-09-29 01:15:03', '078', 'bct', '5', 'sagarmatha'),
(42, 'Deadline for Communication English is tomorrow', 'unread', '2024-09-29 01:15:09', '078', 'bct', '5', 'sagarmatha'),
(53, 'New Notice from IOE: Online Form : BE/BAR (New Course) I Year I Part (Back) for 2081 Kartik', 'unread', '2024-10-02 08:19:26', '081', 'bct', '5', 'sagarmatha'),
(54, 'New Notice from IOE: Routine: BE/BAR  (New Course) I year I part (Back) - 2081 Kartik', 'unread', '2024-10-02 08:23:48', '078', 'bct', '5', 'sagarmatha'),
(47, 'Assignment of Communication English is added. Deadline is 2024-10-01.', 'unread', '2024-10-02 07:45:07', '078', 'bct', '5', 'sagarmatha'),
(55, 'New Notice from IOE', 'unread', '2024-10-02 12:35:33', '0', '0', '5', '0');

-- --------------------------------------------------------

--
-- Table structure for table `old_question`
--

CREATE TABLE `old_question` (
  `id` int(11) NOT NULL,
  `semester` varchar(50) NOT NULL,
  `faculty` varchar(50) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `batch` varchar(10) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `pdf_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `old_question`
--

INSERT INTO `old_question` (`id`, `semester`, `faculty`, `subject`, `batch`, `detail`, `pdf_name`) VALUES
(2, 'Semester 5', 'bct', 'Communication English', 'old', 'old question', 'Communication English.pdf'),
(3, 'Semester 5', 'bct', 'Probability and Statistics', 'old', 'old question', 'Probability and Statistics.pdf'),
(4, 'Semester 5', 'bct', 'Computer Organization and Architecture', 'old', 'old question', 'Computer Organization and Architecture.pdf'),
(5, 'Semester 5', 'bct', 'Software Engineering', 'old', 'old question', 'Software Engineering.pdf'),
(6, 'Semester 5', 'bct', 'Computer Graphics', 'old', 'old question', 'Computer Graphics.pdf'),
(7, 'Semester 5', 'bct', 'Instrumentation II', 'old', 'old question', 'Instrumentation II.pdf'),
(8, 'Semester 5', 'bct', 'Data Communication', 'old', 'old question', 'Data Communication.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `opt`
--

CREATE TABLE `opt` (
  `id` int(11) NOT NULL,
  `gmail` varchar(50) NOT NULL,
  `code` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `opt`
--

INSERT INTO `opt` (`id`, `gmail`, `code`, `time`) VALUES
(7, '078bct031.sangam@sagarmatha.edu.np', 6804, '2024-10-02 13:07:57'),
(6, '078bct031.sangam@sagarmatha.edu.np', 9762, '2024-10-02 13:03:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `pic` varchar(200) NOT NULL,
  `intake_year` varchar(10) NOT NULL,
  `faculty` varchar(10) NOT NULL,
  `college` varchar(10) NOT NULL,
  `endpoint` varchar(255) NOT NULL,
  `p256dh` varchar(255) NOT NULL,
  `auth` varchar(255) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignmentlist`
--
ALTER TABLE `assignmentlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cr`
--
ALTER TABLE `cr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `old_question`
--
ALTER TABLE `old_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `opt`
--
ALTER TABLE `opt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignmentlist`
--
ALTER TABLE `assignmentlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `cr`
--
ALTER TABLE `cr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `old_question`
--
ALTER TABLE `old_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `opt`
--
ALTER TABLE `opt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
