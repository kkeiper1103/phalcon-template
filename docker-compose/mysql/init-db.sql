create database if not exists `phalcon_site`;
use `phalcon_site`;

CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    slug VARCHAR(255) NOT NULL UNIQUE,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO posts (title, slug, content, author) VALUES
    ('Post One', 'lorem', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam.', 'John Doe'),
    ('Post Two', 'nisi', 'Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris.', 'Jane Smith'),
    ('Post Three', 'fusce', 'Fusce nec tellus sed augue semper porta. Mauris massa. Vestibulum lacinia arcu eget nulla.', 'Alice Johnson'),
    ('Post Four', 'ligula', 'Curabitur sodales ligula in libero. Sed dignissim lacinia nunc. Curabitur tortor.', 'Bob Williams'),
    ('Post Five', 'volutpat', 'Quisque volutpat condimentum velit. Class aptent taciti sociosqu ad litora torquent per conubia nostra.', 'Eve Adams');


CREATE TABLE users
(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- default password is "password"
INSERT INTO users (name, email, password) VALUES
     ('admin', 'admin@example.com', '$2y$10$g2NAzAjbbSh6I7hK35qfluGKW7PbaxxOsEC8dYSEl58ASQ0wPKtya');