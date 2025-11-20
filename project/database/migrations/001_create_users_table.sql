CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE IF NOT EXISTS digitale_finds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    type VARCHAR(100),
    discover_date DATE,
    file_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO digitale_finds (title, description, type, discover_date, file_url) VALUES
('Eerste Instagram Post', 'social post', 'Een wazige foto van een koffie, gepost op Instagram in 2010 – één van de eerste sociale beelden van de 21e eeuw.', '2125-03-12', 'https://futureheritage.org/vondsten/insta1.jpg'),
('HTML Startpagina', 'website', 'Een eenvoudige HTML-pagina met knipperende tekst en een gif-achtergrond, typerend voor de vroege internetjaren.', '2125-03-14', 'https://futureheritage.org/vondsten/startpagina.html'),
('Meme: Distracted Boyfriend', 'meme', 'Een populaire internetmeme uit 2017 die menselijke relaties parodieerde met stockfoto’s.', '2125-03-15', 'https://futureheritage.org/vondsten/distracted.jpg'),
('TikTok Dansvideo', 'video', 'Korte dansvideo met trending muziek uit 2020. Veel bekeken en gedeeld door jongeren.', '2125-03-16', 'https://futureheritage.org/vondsten/tiktokdance.mp4'),
('Twitter Bericht: Eerste Tweet', 'social post', 'Het allereerste bericht op Twitter: \"just setting up my twttr\" – een digitaal artefact van online communicatie.', '2125-03-17', 'https://futureheritage.org/vondsten/tweet1.png'),
('YouTube Clip: “Charlie bit my finger”', 'video', 'Een virale video uit 2007 die humor en huiselijke momenten toonde, symbool van vroege virale cultuur.', '2125-03-18', 'https://futureheritage.org/vondsten/charlie.mp4'),
('CSS Stylesheet', 'codefragment', 'Een oud stylesheet dat laat zien hoe websites in 2020 werden vormgegeven met flexbox en gradients.', '2125-03-19', 'https://futureheritage.org/vondsten/style2020.css'),
('Forum Post: MySpace Tips', 'social post', 'Een reeks berichten met tips om je MySpace-profiel te versieren, een sociaal platform vóór Facebook.', '2125-03-20', 'https://futureheritage.org/vondsten/myspace.txt'),
('Nieuwsartikel: Internet Blackout 2024', 'website', 'Een krantenartikel over een grote internetstoring die miljoenen gebruikers trof in 2024.', '2125-03-21', 'https://futureheritage.org/vondsten/blackout.html'),
('AI Chat Transcript', 'codefragment', 'Een gesprek met een vroeg AI-model dat laat zien hoe mens en machine begonnen te communiceren.', '2125-03-22', 'https://futureheritage.org/vondsten/ai_chat.txt');

