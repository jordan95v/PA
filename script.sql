USE leslumieres;
-- Table creation
CREATE TABLE petitchat_user(
  id INT PRIMARY KEY AUTO_INCREMENT,
  email VARCHAR(255) ,
  username VARCHAR(60) ,
  pwd VARCHAR(255) ,
  creation_date timestamp  DEFAULT CURRENT_TIMESTAMP,
  update_date timestamp  DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  statut TINYINT(4)  DEFAULT '0',
  is_admin TINYINT(4)  DEFAULT '0',
  super_admin TINYINT(4)  DEFAULT '0',
  token VARCHAR(40) DEFAULT NULL,
  confirmKey INT DEFAULT NULL,
  newsletter TINYINT(4)  DEFAULT '0',
  banned INT  DEFAULT '0',
  head char(8)  DEFAULT 'head-1',
  eyes char(6)  DEFAULT 'eyes-1',
  mouth char(7)  DEFAULT 'mouth-1'
);

CREATE TABLE groschien_film(
  id INT PRIMARY KEY AUTO_INCREMENT,
  image_path VARCHAR(255),
  title VARCHAR(60),
  genre VARCHAR(20),
  maker VARCHAR(40),
  actors VARCHAR(255),
  info TEXT,
  duration CHAR(5);
  creation_date timestamp DEFAULT CURRENT_TIMESTAMP,
  update_date timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  featured TINYINT(4) DEFAULT '0'
);

CREATE TABLE geantemarmotte_forum(
  id INT PRIMARY KEY AUTO_INCREMENT,
  film_subject VARCHAR(60),
  title TEXT,
  content TEXT,
  id_author INT REFERENCES petitchat_user(id),
  username_author VARCHAR(255),
  date_publication TEXT
);

-- Table creation
CREATE TABLE enormepingouin_like(
  id INT PRIMARY KEY AUTO_INCREMENT,
  film_id INT REFERENCES groschien_film(id),
  user_id INT REFERENCES petitchat_user(id),
  value INT 
);

CREATE TABLE geantemarmotte_comments(
  id INT PRIMARY KEY AUTO_INCREMENT,
  id_author INT REFERENCES petitchat_user(id),
  username_author VARCHAR(255),
  id_subject INT REFERENCES geantemarmotte_forum(id),
  content TEXT,
  date_publication TEXT 
);

CREATE TABLE gigaecureil_event(
  id INT PRIMARY KEY AUTO_INCREMENT,
  image_event VARCHAR(255),
  title VARCHAR(60),
  type_event VARCHAR(20),
  maker VARCHAR(40),
  actors VARCHAR(100),
  content VARCHAR(255),
  start_date_event TEXT,
  end_date_event TEXT,
  featured TINYINT(4) DEFAULT '1',
  like_count INT DEFAULT '0',
  dislike_count INT DEFAULT '0'
);

CREATE TABLE grandcanard_logs(
  id INT PRIMARY KEY AUTO_INCREMENT,
  view VARCHAR(50),
  connection INT DEFAULT '0'
);

CREATE TABLE megalapin_ticket(
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT REFERENCES petitchat_user(id),
  film_id INT REFERENCES groschien_film(id),
  film_name VARCHAR(50),
  ticket VARCHAR(70),
  place INT,
  date VARCHAR(20),
  time VARCHAR(20),
  code INT
);

CREATE TABLE minisculecome_newsletter(
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT REFERENCES petitchat_user(id),
  subject VARCHAR(90) DEFAULT NULL,
  content VARCHAR(250) DEFAULT NULL,
  send_date timestamp  DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE moyenlezard_user_logs(
  id INT PRIMARY KEY AUTO_INCREMENT,
  type VARCHAR(50) DEFAULT NULL,
  date timestamp  DEFAULT CURRENT_TIMESTAMP,
  user_id INT REFERENCES petitchat_user(id)
);



INSERT INTO petitchat_user(id, email, username, pwd, creation_date, update_date, statut, is_admin, super_admin, token, confirmKey, newsletter, banned, head, eyes, mouth) VALUES
(1, 'jordan.dfrsne@dufrsne.com', 'jdufresne3', '$2y$10$2xkaDyqa5UkuhjH3qYL7Mu2GQxp2RltzlC1Ka0dj5e5loC3ZH944K', '2022-04-12 15:05:47', '2022-05-31 10:09:03', 1, 0, 0, 'b76f91a2e17ce9d019354849c5ca51c6a0e83391', NULL, 0, 0, 'head-1', 'eyes-1', 'mouth-1'),
(4, 'sananes@esgi.fr', 'sananes', '$2y$10$HEaYSc1Fk3FtL0nh/1Cn7O3xLhR52S06ds0/YUSJW9dMF9dfHPJSC', '2022-04-12 15:35:24', '2022-06-30 15:24:42', 0, 0, 0, NULL, NULL, 0, 1, 'head-1', 'eyes-1', 'mouth-1'),
(14, 'jdrpythontest@gmail.com', 'jordan95va', '$2y$10$8mtvoCCPabJSqoXchOh0lOiG0BYuA4pHHdZttlC2hDkDAqYpEJgTi', '2022-05-09 10:37:42', '2022-07-02 14:56:24', 1, 1, 1, 'a7206552ff86fb35dfc75778f92db50f269209eb', 7206144, 0, 0, 'head-4', 'eyes-2', 'mouth-2');

COMMIT;