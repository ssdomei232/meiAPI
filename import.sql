CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    filename VARCHAR(255) NOT NULL,
    p_id VARCHAR(255),
    artist_id VARCHAR(255),
    theme ENUM('dark', 'light', 'fox', 'favicon', 'rainyun', 'bj') NOT NULL,
    source VARCHAR(255),
    webp_path VARCHAR(255)
);

CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE
);

CREATE TABLE image_tags (
    image_id INT,
    tag_id INT,
    FOREIGN KEY (image_id) REFERENCES images(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id),
    PRIMARY KEY (image_id, tag_id)
);