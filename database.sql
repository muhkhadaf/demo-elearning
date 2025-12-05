CREATE DATABASE IF NOT EXISTS `siakad_mdt` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `siakad_mdt`;

CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role ENUM('admin','teacher','student') NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  INDEX idx_role (role)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS teachers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL UNIQUE,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100),
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS academic_years (
  id INT AUTO_INCREMENT PRIMARY KEY,
  label VARCHAR(20) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 0,
  UNIQUE KEY uniq_label (label)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS classes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50) NOT NULL,
  academic_year_id INT NOT NULL,
  homeroom_teacher_id INT NULL,
  FOREIGN KEY (academic_year_id) REFERENCES academic_years(id) ON DELETE RESTRICT,
  FOREIGN KEY (homeroom_teacher_id) REFERENCES teachers(id) ON DELETE SET NULL,
  UNIQUE KEY uniq_class_year (name, academic_year_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  UNIQUE KEY uniq_subject_name (name)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS class_students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  student_id INT NOT NULL,
  FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_class_student (class_id, student_id),
  INDEX idx_class_id (class_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS class_subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_id INT NOT NULL,
  subject_id INT NOT NULL,
  teacher_id INT NOT NULL,
  FOREIGN KEY (class_id) REFERENCES classes(id) ON DELETE CASCADE,
  FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_class_subject (class_id, subject_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS materials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_subject_id INT NOT NULL,
  teacher_id INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  file_path VARCHAR(255) NOT NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_subject_id) REFERENCES class_subjects(id) ON DELETE CASCADE,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE,
  INDEX idx_material_cs (class_subject_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS assignments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  class_subject_id INT NOT NULL,
  teacher_id INT NOT NULL,
  title VARCHAR(150) NOT NULL,
  description TEXT,
  due_date DATETIME NULL,
  attachment_path VARCHAR(255) NULL,
  created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (class_subject_id) REFERENCES class_subjects(id) ON DELETE CASCADE,
  FOREIGN KEY (teacher_id) REFERENCES teachers(id) ON DELETE CASCADE,
  INDEX idx_assignment_cs (class_subject_id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS submissions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  assignment_id INT NOT NULL,
  student_id INT NOT NULL,
  file_path VARCHAR(255) NOT NULL,
  submitted_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  score DECIMAL(5,2) NULL,
  feedback TEXT NULL,
  FOREIGN KEY (assignment_id) REFERENCES assignments(id) ON DELETE CASCADE,
  FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_assignment_student (assignment_id, student_id),
  INDEX idx_submission_assignment (assignment_id)
) ENGINE=InnoDB;