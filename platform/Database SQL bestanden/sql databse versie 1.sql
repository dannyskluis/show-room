-- Maak de database aan
CREATE DATABASE platform;

-- Selecteer de database
USE platform;

-- Tabel voor projectgeschiedenis
CREATE TABLE project_history (
    history_id INT AUTO_INCREMENT PRIMARY KEY,
    beschrijving VARCHAR(255)
);

-- Tabel voor klanten
CREATE TABLE clients (
    client_id INT AUTO_INCREMENT PRIMARY KEY,
    client_name VARCHAR(255) NOT NULL,
    email VARCHAR(255),
    phone_number VARCHAR(20)
);

-- Tabel voor zzprs
CREATE TABLE zzprs (
    zzpr_id INT AUTO_INCREMENT NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    lastname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone_number INT(20),
    password VARCHAR(255),
    PRIMARY KEY (zzpr_id)
);

-- Tabel voor projecten
CREATE TABLE projects (
    project_id INT AUTO_INCREMENT PRIMARY KEY,
    zzpr_id INT NOT NULL,
    project_name VARCHAR(255) NOT NULL,
    client_id INT NOT NULL,
    start_date DATE,
    end_date DATE,
    hourly_rate DECIMAL(10, 2) NOT NULL,
    project_status ENUM('Planned', 'In Progress', 'Completed') DEFAULT 'Planned',
    project_history INT,
    FOREIGN KEY (project_history) REFERENCES project_history(history_id),
    FOREIGN KEY (client_id) REFERENCES clients(client_id),
    FOREIGN KEY (zzpr_id) REFERENCES zzprs(zzpr_id),
    CONSTRAINT chk_hourly_rate CHECK (hourly_rate > 0)  -- Voeg een controle toe voor positieve hourly_rate
);
