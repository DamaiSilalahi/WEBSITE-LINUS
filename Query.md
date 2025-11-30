CREATE TABLE coordinates (
    id SERIAL PRIMARY KEY,
    latitude NUMERIC(10, 8) NOT NULL,
    longitude NUMERIC(11, 8) NOT NULL,
    is_halte BOOLEAN
);

INSERT INTO coordinates (latitude, longitude, is_halte)
VALUES
    (3.5661253, 98.6600667, TRUE),     -- halte pintu 1
    (3.5665446, 98.6600436, FALSE),
    (3.5665478, 98.6601728, FALSE),
    (3.5626565, 98.6603916, TRUE),    -- halte pendopo
    (3.5592630, 98.6604540, TRUE),    -- halte hukum 1
    (3.5562021, 98.6605685, FALSE),
    (3.5560161, 98.6605245, FALSE),
    (3.5560191, 98.6604411, TRUE),    -- halte pintu doraemon
    (3.5563223, 98.6604120, FALSE),
    (3.5563180, 98.6577221, TRUE),    -- halte fisip 1
    (3.5563505, 98.6561159, FALSE),
    (3.5574176, 98.6561051, TRUE),    -- halte feb 1
    (3.5590408, 98.6561385, FALSE),
    (3.5590090, 98.6555590, TRUE),    -- halte fmipa 1
    (3.5589980, 98.6528885, FALSE),
    (3.5594377, 98.6528921, TRUE),    -- halte jebol 1
    (3.5607190, 98.6528930, TRUE),    -- halte farmasi 1
    (3.5666520, 98.6531422, TRUE),    -- halte pintu 4
    (3.5668220, 98.6531433, FALSE),
    (3.5668030, 98.6532490, FALSE),
    (3.5606290, 98.6530620, TRUE),    -- halte farmasi 2
    (3.5594515, 98.6530292, TRUE),    -- halte jebol 2
    (3.5590288, 98.6530176, FALSE),
    (3.5590666, 98.6555478, TRUE),    -- halte fmipa 2
    (3.5590690, 98.6561599, FALSE),
    (3.5574464, 98.6561507, TRUE),    -- halte feb 2
    (3.5563676, 98.6561415, FALSE),
    (3.5563558, 98.6576004, TRUE),    -- halte fisip 2
    (3.5563454, 98.6603466, TRUE),    -- halte doraemon 2
    (3.5563465, 98.6604199, FALSE),
    (3.5591868, 98.6602957, TRUE),    -- halte hukum 2
    (3.5635686, 98.6601725, TRUE);    -- halte gelanggang

CREATE TABLE bus_stop (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    coordinate_id INT REFERENCES coordinates(id)
);

INSERT INTO bus_stop (name, coordinate_id)
VALUES
    ('Halte Pintu 1', 1),
    ('Halte Pendopo', 4),
    ('Halte Hukum 1', 5),
    ('Halte Pintu Doraemon', 8),
    ('Halte Fisip 1', 10),
    ('Halte FEB 1', 12),
    ('Halte FMIPA 1', 14),
    ('Halte Jebol 1', 16),
    ('Halte Farmasi 1', 17),
    ('Halte Pintu 4', 18),
    ('Halte Farmasi 2', 21),
    ('Halte Jebol 2', 22),
    ('Halte FMIPA 2', 24),
    ('Halte FEB 2', 26),
    ('Halte Fisip 2', 28),
    ('Halte Doraemon 2', 29),
    ('Halte Hukum 2', 31),
    ('Halte Gelanggang', 32);

CREATE TABLE bus_route (
    id SERIAL PRIMARY KEY,
    coordinate_id INT REFERENCES coordinates(id),
    sequence INT NOT NULL
);

INSERT INTO bus_route (coordinate_id, sequence)
VALUES
    (1, 1),
    (2, 2),
    (3, 3),
    (4, 4),
    (5, 5),
    (6, 6),
    (7, 7),
    (8, 8),
    (9, 9),
    (10, 10),
    (11, 11),
    (12, 12),
    (13, 13),
    (14, 14),
    (15, 15),
    (16, 16),
    (17, 17),
    (18, 18),
    (19, 19),
    (20, 20),
    (21, 21),
    (22, 22),
    (23, 23),
    (24, 24),
    (25, 25),
    (26, 26),
    (27, 27),
    (28, 28),
    (29, 29),
    (30, 30),
    (31, 31),
    (32, 32);
    
CREATE TABLE bus (
    id SERIAL PRIMARY KEY,
    plat_nomor VARCHAR(50) NOT NULL UNIQUE
);

CREATE TABLE driver_bus (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE,
);

CREATE TABLE driver_location (
    id SERIAL PRIMARY KEY,
    driver_id INT REFERENCES driver_bus(id) ON DELETE CASCADE,
    bus_id INT REFERENCES bus(id) ON DELETE CASCADE,
    latitude NUMERIC(10, 8) NOT NULL,
    longitude NUMERIC(11, 8) NOT NULL,
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    is_active BOOLEAN
);

CREATE TABLE admin (
    id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(100) NOT NULL
);
