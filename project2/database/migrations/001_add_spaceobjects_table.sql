CREATE TABLE IF NOT EXISTS SpaceObjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type VARCHAR(50) NOT NULL,
    discovered_date DATE,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    image_filename VARCHAR(255),
    file_url VARCHAR(255) NOT NULL
);