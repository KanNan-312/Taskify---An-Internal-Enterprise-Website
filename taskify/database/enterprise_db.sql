SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `enterprise_db`
--

-- --------------------------------------------------------
--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 3 COMMENT '1 = admin/boss, 2 = manager, 3 = staff',
  `avatar` varchar(255) NOT NULL DEFAULT 'no-image-available.png',
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `users`
--
-- type 1: admin/boss, type 2: project manager, type 3: employee
INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`) VALUES
(1, 'Administrator', '', 'admin@admin.com', '0192023a7bbd73250516f069df18b500', 1, 'no-image-available.png', '2021-11-26 10:57:04'),
(2, 'Khang', 'Ho', 'khangho@taskify.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', '2021-12-03 09:26:03'),
(3, 'Tuan', 'Dao Tien', 'tuandt@taskify.com', '202cb962ac59075b964b07152d234b70', 1, 'no-image-available.png', '2021-11-03 09:26:03'),
(4, 'Trinh', 'Pham Khanh', 'trinhpk@taskify.com', '202cb962ac59075b964b07152d234b70', 2, 'no-image-available.png', '2022-08-03 09:26:03'),
(5, 'Huan', 'Pham Bui Minh', 'huanpbm@taskify.com', '202cb962ac59075b964b07152d234b70', 2, 'no-image-available.png', '2022-12-03 09:26:03'),
(6, 'Khoi', 'Nguyen Luat Gia', 'khoinlg@taskify.com', '202cb962ac59075b964b07152d234b70', 2, 'no-image-available.png', '2022-07-03 09:26:03'),
(7, 'Khoa', 'Vo Dang', 'khoavd@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-12-12 09:26:03'),
(8, 'Hoang', 'Do Minh', 'hoangdm@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-04-13 09:26:03'),
(9, 'Duy', 'Tran Minh', 'duytm@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-06-29 09:26:03'),
(10, 'Dung', 'Nguyen Duc', 'dungnd@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-08-19 09:26:03'),
(11, 'Tan', 'Tran Minh', 'tantm@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-09-20 09:26:03'),
(12, 'Hung', 'Tran Duy', 'duyth@taskify.com', '202cb962ac59075b964b07152d234b70', 3, 'no-image-available.png', '2022-06-23 09:26:03');


-- --------------------------------------------------------

--
-- Table structure for table `project_list`
--

CREATE TABLE `project_list` (
  `id` int(30) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(2) NOT NULL COMMENT '1 = pending, 2 = in progress, 3 = done',
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `manager_id` int(30) NOT NULL REFERENCES `users`(`id`),
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `project_list`
--

INSERT INTO `project_list` (`id`, `name`, `description`, `status`, `start_date`, `end_date`, `manager_id`, `date_created`) VALUES
(1, 'Vietnamese OCR platform', 'Platform to OCR and transform popular documents', 2, '2022-12-02', '2023-04-30', 4, '2022-12-01 13:51:54'),
(2, 'Real estate recommendation system', 'Recommendation system to recommend suitable real estate for customers in need', 1, '2022-12-31', '2023-12-31', 5, '2022-12-05 13:51:54'),
(3, 'Vietnamese subtitle generator', 'Vietnamese subtitle generator for video and audio files', 1, '2022-11-25', '2023-5-22', 6, '2022-11-13 13:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `works_on`
--

CREATE TABLE `works_on` (
  `user_id` int(30) REFERENCES `users`(`id`),
  `project_id` int(30) REFERENCES `project_list`(`id`),
  PRIMARY KEY (`user_id`, `project_id`)
);


INSERT INTO `works_on` (`user_id`, `project_id`) VALUES
(7, 1), (8, 1), (9, 1),
(8, 2), (10, 2), (11, 2), (12, 2),
(7, 3), (9, 3), (10, 3), (11, 3), (12, 3);
-- --------------------------------------------------------



--
-- Table structure for table `task_list`
--

CREATE TABLE `task_list` (
  `id` int(30) NOT NULL,
  `project_id` int(30) NOT NULL REFERENCES `project_list`(`id`),
  `assignee_id` int(30) NOT NULL REFERENCES `users`(`id`),
  `task` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '1 = pending, 2 = in progress, 3 = done',
  `deadline` datetime NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
);

--
-- Dumping data for table `task_list`
--

INSERT INTO `task_list` (`id`, `project_id`, `assignee_id`, `task`, `description`, `status`, `date_created`, `deadline`) VALUES
(1, 1, 7, 'Research OCR engines', 'Research and create a survey report on state-of-the-art OCR engines', 2, '2022-12-06 17:08:58', '2022-12-20 11:08:58'),
(2, 1, 8, 'Setup hardware', 'Request and setup development server for team members', 2, '2020-12-06 17:08:58', '2022-12-13 11:08:58'),
(3, 1, 9, 'Research datasets', 'Research and create a survey report on current OCR datasets', 2, '2022-12-06 17:08:58', '2022-12-20 11:08:58'),
(4, 1, 9, 'Competitiveness Study', 'Study on competitiveness of the project', 2, '2022-12-06 17:08:58', '2022-12-20 11:08:58'),
(5, 2, 10, 'Research RS', 'Research and create a survey report on state-of-the-art recommendation systems', 1, '2022-12-31 15:09:58', '2023-01-14 11:08:58'),
(6, 2, 11, 'Competitiveness Study', 'Study on competitiveness of the project', 2, '2022-12-06 17:08:58', '2022-12-20 11:08:58'),
(7, 2, 11, 'Setup hardware', 'Request and setup development server for team members', 1, '2022-12-31 15:09:58', '2023-01-14 11:08:58'),
(8, 2, 12, 'Summary data', 'Summary customer information', 1, '2022-12-31 15:09:58', '2023-01-21 11:08:58'),
(9, 2, 11, 'Mining data', 'Mining customer data', 1, '2022-01-14 15:09:58', '2023-01-21 11:08:58'),
(10, 3, 7, 'Research SOTA language models', 'Research and create a survey report on state-of-the-art language model for subtitle generation', 1, '2022-11-25 15:09:58', '2022-12-14 11:08:58'),
(11, 3, 12, 'Feasibility study', 'Study on feasibility of the project', 1, '2022-11-25 15:09:58', '2022-12-14 11:08:58'),
(12, 3, 9, 'Setup hardware', 'Request and setup development server for team members', 1, '2022-11-25 15:09:58', '2022-12-14 11:08:58'),
(13, 3, 10, 'Research datasets', 'Research and create a survey report on current Vietnamese corpus', 1, '2022-11-25 15:09:58', '2022-12-14 11:08:58'),
(14, 3, 11, 'Competitiveness Study', 'Study on competitiveness of the project', 1, '2022-11-25 15:09:58', '2022-12-14 11:08:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_productivity`
--

-- CREATE TABLE `user_productivity` (
--   `id` int(30) NOT NULL,
--   `project_id` int(30) NOT NULL,
--   `task_id` int(30) NOT NULL,
--   `comment` text NOT NULL,
--   `subject` varchar(200) NOT NULL,
--   `date` date NOT NULL,
--   `start_time` time NOT NULL,
--   `end_time` time NOT NULL,
--   `user_id` int(30) NOT NULL,
--   `time_rendered` float NOT NULL,
--   `date_created` datetime NOT NULL DEFAULT current_timestamp(),
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --
-- -- Dumping data for table `user_productivity`
-- --

-- INSERT INTO `user_productivity` (`id`, `project_id`, `task_id`, `comment`, `subject`, `date`, `start_time`, `end_time`, `user_id`, `time_rendered`, `date_created`) VALUES
-- (1, 1, 1, '&lt;p&gt;Sample Progress&lt;/p&gt;&lt;ul&gt;&lt;li&gt;Test 1&lt;/li&gt;&lt;li&gt;Test 2&lt;/li&gt;&lt;li&gt;Test 3&lt;/li&gt;&lt;/ul&gt;																			', 'Sample Progress', '2020-12-03', '08:00:00', '10:00:00', 1, 2, '2020-12-03 12:13:28'),
-- (2, 1, 1, 'Sample Progress						', 'Sample Progress 2', '2020-12-03', '13:00:00', '14:00:00', 1, 1, '2020-12-03 13:48:28'),
-- (3, 1, 2, 'Sample						', 'Test', '2020-12-03', '08:00:00', '09:00:00', 5, 1, '2020-12-03 13:57:22'),
-- (4, 1, 2, 'asdasdasd', 'Sample Progress', '2020-12-02', '08:00:00', '10:00:00', 2, 2, '2020-12-03 14:36:30');


--
-- AUTO_INCREMENT for table `project_list`
--
ALTER TABLE `project_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `task_list`
--
ALTER TABLE `task_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_productivity`
--
-- ALTER TABLE `user_productivity`
--   MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

COMMIT;