CREATE TABLE students (
  id INT AUTO_INCREMENT PRIMARY KEY,
  reg_id VARCHAR(50) UNIQUE,
  name VARCHAR(150),
  father_name VARCHAR(150),
  mobile VARCHAR(20),
  email VARCHAR(150),
  course VARCHAR(100),
  address TEXT,
  payment_status VARCHAR(30) DEFAULT 'Pending',
  admission_status VARCHAR(30) DEFAULT 'Pending',
  txn_id VARCHAR(100),
  photo VARCHAR(255),
  aadhar VARCHAR(255),
  marksheet VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE admin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(255)
);

INSERT INTO admin (username, password)
VALUES ('admin', '$2y$10$6eZ3U9sG6pGv1b7u2F0c0e1V9BfOaGxKX4Qn9lVQmUe6mJH2ZlHcW');
