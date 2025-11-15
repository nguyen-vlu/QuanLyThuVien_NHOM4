-- database.sql
CREATE DATABASE IF NOT EXISTS thu_vien_vlu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE thu_vien_vlu;



-- Tạo một thể loại mẫu
INSERT INTO categories (name, description) VALUES
('Khoa học', 'Tài liệu khoa học'),
('Du lịch', 'Sách du lịch và cẩm nang');

-- Tạo tài khoản admin mẫu (mật khẩu: admin123) -> bạn nên đổi sau khi cài
INSERT INTO users (full_name, student_id, dob, address, email, password_hash, is_admin)
VALUES ('Admin Văn Lang', 'ADMIN001', '1990-01-01', 'Văn Lang', 'admin@vlu.edu.vn', 
        -- hash của 'admin123' (tạo tương đương trong PHP; ở đây dùng placeholder)
        '$2y$10$wHh3yR9vS6q8DqgkOq2uEO3pQmG6bI3T6Y0l3s3oKZQn2EJ6GmF6', 1);
-- LƯU Ý: nếu nhập bằng phpMyAdmin, hãy tạo user admin bằng form đăng ký để hash đúng.
