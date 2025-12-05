-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 01:29 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siakad_mdt`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_years`
--

CREATE TABLE `academic_years` (
  `id` int(11) NOT NULL,
  `label` varchar(20) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `academic_years`
--

INSERT INTO `academic_years` (`id`, `label`, `is_active`) VALUES
(2, '2025/2026 GANJIL', 0),
(3, '2025/2026 GENAP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL,
  `class_subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `due_date` datetime DEFAULT NULL,
  `attachment_path` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`id`, `class_subject_id`, `teacher_id`, `title`, `description`, `due_date`, `attachment_path`, `created_at`) VALUES
(3, 3, 3, 'Tugas Tanggal 1', 'tugas kumpulkan sini', '2026-02-02 11:11:00', 'asg_1763622138_6fea134a.pdf', '2025-11-20 14:02:18'),
(4, 3, 3, 'Tugas 2', 'tugas ya', '2026-02-12 02:02:00', 'asg_1763625206_6289f8b1.jpeg', '2025-11-20 14:53:26');

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `academic_year_id` int(11) NOT NULL,
  `homeroom_teacher_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `name`, `academic_year_id`, `homeroom_teacher_id`) VALUES
(4, 'KELAS 1A', 2, 3),
(5, 'KELAS 1B', 2, 4),
(6, 'Kelas 1C', 2, 5),
(7, 'KELAS 1D', 2, 6),
(8, 'KELAS 2A', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `class_students`
--

CREATE TABLE `class_students` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_students`
--

INSERT INTO `class_students` (`id`, `class_id`, `student_id`) VALUES
(9, 4, 7),
(10, 4, 8),
(17, 4, 15),
(11, 5, 9),
(12, 5, 10),
(13, 5, 11),
(14, 6, 12),
(15, 7, 13),
(16, 7, 14),
(19, 8, 12),
(18, 8, 14),
(20, 8, 15);

-- --------------------------------------------------------

--
-- Table structure for table `class_subjects`
--

CREATE TABLE `class_subjects` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `day` varchar(10) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_subjects`
--

INSERT INTO `class_subjects` (`id`, `class_id`, `subject_id`, `teacher_id`, `day`, `start_time`, `end_time`) VALUES
(3, 4, 11, 3, NULL, NULL, NULL),
(4, 4, 9, 4, NULL, NULL, NULL),
(5, 4, 10, 5, NULL, NULL, NULL),
(6, 4, 8, 6, NULL, NULL, NULL),
(7, 5, 11, 3, NULL, NULL, NULL),
(9, 5, 9, 4, NULL, NULL, NULL),
(10, 5, 10, 5, NULL, NULL, NULL),
(11, 5, 8, 6, NULL, NULL, NULL),
(12, 6, 11, 3, NULL, NULL, NULL),
(13, 6, 9, 4, NULL, NULL, NULL),
(14, 6, 10, 5, NULL, NULL, NULL),
(15, 6, 8, 6, NULL, NULL, NULL),
(16, 7, 11, 3, NULL, NULL, NULL),
(17, 7, 9, 4, NULL, NULL, NULL),
(19, 7, 10, 5, NULL, NULL, NULL),
(20, 7, 8, 6, NULL, NULL, NULL),
(21, 8, 11, 3, NULL, NULL, NULL),
(23, 8, 10, 5, 'Senin', '07:10:00', '09:10:00');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE `materials` (
  `id` int(11) NOT NULL,
  `class_subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `class_subject_id`, `teacher_id`, `title`, `description`, `file_path`, `created_at`) VALUES
(1, 3, 3, 'Materi tanggal 1', 'materi', 'mat_1763622083_d2a6e1d3.pdf', '2025-11-20 14:01:23');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nis` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `nis`, `email`) VALUES
(7, 17, 'Rizky Febian', NULL, 'rizky@mail.com'),
(8, 18, 'Ridho Febriansyah', NULL, 'Ridho@mail.com'),
(9, 19, 'Mawar Indah Saputri', NULL, 'mawar@mail.com'),
(10, 20, 'MUJI', NULL, 'muji@mail.com'),
(11, 21, 'Yasmin', NULL, 'yasmin@mail.com'),
(12, 22, 'Indah Septiani', NULL, 'indah@mail.com'),
(13, 23, 'Rendiansyah', NULL, 'rendi@mail.com'),
(14, 24, 'Bimo', NULL, 'bimo@mail.com'),
(15, 25, 'khadafi', NULL, 'Muhkhadafi2309@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(11, 'Bahasa Indonesia'),
(9, 'Ilmu Pengetahuan Alam'),
(10, 'Ilmu Pengetahuan Sosial'),
(8, 'Matematika');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `id` int(11) NOT NULL,
  `assignment_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `submitted_at` datetime NOT NULL DEFAULT current_timestamp(),
  `score` decimal(5,2) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `assignment_id`, `student_id`, `file_path`, `submitted_at`, `score`, `feedback`) VALUES
(3, 3, 15, 'sub_1763622164_3f9cd008.pdf', '2025-11-20 14:02:44', 90.00, 'sudah bagus nak');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nip` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `user_id`, `name`, `nip`, `email`) VALUES
(3, 13, 'Arief Sutomo S.pd', '231311', 'arief@mdt.sch.id'),
(4, 14, 'Bambang Ginansyah S.pd', '231411', 'bambang@mdt.sch.id'),
(5, 15, 'Rina Masitoh S.pd', '213412', 'rina@mdt.sch.id'),
(6, 16, 'Sari Gina S.pd', '231341', 'sari@mdt.sch.id');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role` enum('admin','teacher','student') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$800a455e02cab717b8269166c5b7c9987a6e5291f79d85620b016', 'admin', '2025-11-17 20:41:44'),
(2, 'admin2', '$2y$10$8NZP5h99U2LVm4Bz4vQkPuu7f1k/Mr5tRPEeZ93mH9pgIK0Wb1VN6', 'admin', '2025-11-17 20:48:10'),
(13, 'arief', '$2y$10$EwjCxzGW.Z4P1NJ1K7I5B.GFWMBgBANLTz98K.HjBVPxeZ3VtSoBe', 'teacher', '2025-11-20 13:46:19'),
(14, 'bambang', '$2y$10$YK.Y3peC/uddE0xBUcG9iebTeNbDBzpxMC2k5JzfbuxM/EBUlfLEK', 'teacher', '2025-11-20 13:46:59'),
(15, 'rina', '$2y$10$jBn.AQsOJS.Wk.3VwGQ2CugHKP0L308kZfAEbJtpJeQGKs73rIF.u', 'teacher', '2025-11-20 13:47:52'),
(16, 'sari', '$2y$10$3lv/Vml3sCuZlz3tAWz8a.VhQnzlifpdSFRh3hUSzbzo1wxaO2KWe', 'teacher', '2025-11-20 13:48:59'),
(17, 'rizky', '$2y$10$dJpBk2E9Te0vQipAIv7V1.54rfg/3AZ5s9PPGmm7vNj49U5wl5/G2', 'student', '2025-11-20 13:51:11'),
(18, 'ridho', '$2y$10$ekVLifHafB.im9r.c3qAdur4Tyy4CureVx5X9Ff3RCE1Vaoo2Ksry', 'student', '2025-11-20 13:51:34'),
(19, 'mawar', '$2y$10$8XMpsG8A0Lqg2Qf8dhYFq.fG8jnHd0hUV2YeUD06PgeX/Fp1ZnALa', 'student', '2025-11-20 13:52:14'),
(20, 'muji', '$2y$10$I269UdxCwb4qONX70HZDrefERioCxrBeJ46cmEsYQRPJNRjEGAq8O', 'student', '2025-11-20 13:52:40'),
(21, 'yasmin', '$2y$10$76Abj6.NtK1X5ANGV7gHKO0rp40TRKQev0PzH8JgHtAfnhLmJ2ngi', 'student', '2025-11-20 13:52:57'),
(22, 'indah', '$2y$10$/GJzLL4R56B93.bhSzoJuO2kWgCOISrSuPxIPAqFj3pTlb5t.Rgvm', 'student', '2025-11-20 13:53:41'),
(23, 'rendi', '$2y$10$oJ2vEsoMpwSc3plDWPp6tOF9j6b1Vbp5TUDxiX7Lk8Q6u1FSM6AEC', 'student', '2025-11-20 13:54:10'),
(24, 'bimo', '$2y$10$Ad8R295X5wU0o1cbNKV/yeQtdydFBZ3G1AjwLy23bm2iw7YIHoetu', 'student', '2025-11-20 13:54:28'),
(25, 'khadafi', '$2y$10$WXFbWvdTUwkamsxJC0g.C.F7XZYQOKpLIHNC3Fp1.VBzTnUCU9R0y', 'student', '2025-11-20 14:00:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_years`
--
ALTER TABLE `academic_years`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_label` (`label`);

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `idx_assignment_cs` (`class_subject_id`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_class_year` (`name`,`academic_year_id`),
  ADD KEY `academic_year_id` (`academic_year_id`),
  ADD KEY `homeroom_teacher_id` (`homeroom_teacher_id`);

--
-- Indexes for table `class_students`
--
ALTER TABLE `class_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_class_student` (`class_id`,`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `idx_class_id` (`class_id`);

--
-- Indexes for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_class_subject` (`class_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `materials`
--
ALTER TABLE `materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `idx_material_cs` (`class_subject_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_subject_name` (`name`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_assignment_student` (`assignment_id`,`student_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `idx_submission_assignment` (`assignment_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_role` (`role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_years`
--
ALTER TABLE `academic_years`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `class_students`
--
ALTER TABLE `class_students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `class_subjects`
--
ALTER TABLE `class_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `materials`
--
ALTER TABLE `materials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignments`
--
ALTER TABLE `assignments`
  ADD CONSTRAINT `assignments_ibfk_1` FOREIGN KEY (`class_subject_id`) REFERENCES `class_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assignments_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`academic_year_id`) REFERENCES `academic_years` (`id`),
  ADD CONSTRAINT `classes_ibfk_2` FOREIGN KEY (`homeroom_teacher_id`) REFERENCES `teachers` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `class_students`
--
ALTER TABLE `class_students`
  ADD CONSTRAINT `class_students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_students_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `class_subjects`
--
ALTER TABLE `class_subjects`
  ADD CONSTRAINT `class_subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `class_subjects_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `materials`
--
ALTER TABLE `materials`
  ADD CONSTRAINT `materials_ibfk_1` FOREIGN KEY (`class_subject_id`) REFERENCES `class_subjects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `materials_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`assignment_id`) REFERENCES `assignments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
