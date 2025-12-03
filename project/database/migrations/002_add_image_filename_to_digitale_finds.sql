ALTER TABLE IF EXISTS digitale_finds 
ADD COLUMN image_filename VARCHAR(255) NULL AFTER file_url;

CREATE INDEX IF NOT EXISTS idx_image_filename ON digitale_finds(image_filename);
