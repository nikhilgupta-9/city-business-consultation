-- Soft City landing page: lead storage.
-- Create a database first (name must match 'db' > 'name' in config.php), then import this file.
--   mysql -u root -p softcity_landing < database/schema.sql

CREATE TABLE IF NOT EXISTS landing_leads (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name          VARCHAR(120)  NOT NULL,
    phone         VARCHAR(40)   NOT NULL,
    email         VARCHAR(190)  NOT NULL,
    service       VARCHAR(120)  NOT NULL DEFAULT '',
    message       TEXT          NULL,
    consent       TINYINT(1)    NOT NULL DEFAULT 0,

    -- Where the lead came from (filled from the ad's URL parameters)
    utm_source    VARCHAR(150)  NOT NULL DEFAULT '',
    utm_medium    VARCHAR(150)  NOT NULL DEFAULT '',
    utm_campaign  VARCHAR(150)  NOT NULL DEFAULT '',
    utm_content   VARCHAR(150)  NOT NULL DEFAULT '',
    utm_term      VARCHAR(150)  NOT NULL DEFAULT '',
    fbclid        VARCHAR(255)  NOT NULL DEFAULT '',

    -- For your own follow-up tracking
    status        ENUM('new','contacted','qualified','won','lost') NOT NULL DEFAULT 'new',
    notes         TEXT          NULL,
    created_at    DATETIME      NOT NULL DEFAULT CURRENT_TIMESTAMP,

    KEY idx_status (status),
    KEY idx_campaign (utm_campaign),
    KEY idx_created (created_at)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
