BEGIN TRANSACTION;

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  username TEXT NOT NULL,
  password TEXT NOT NULL,
  firstname TEXT NOT NULL,
  lastname TEXT NOT NULL,
  user_status INTEGER NOT NULL,
  email TEXT NOT NULL UNIQUE,
  grad_year INTEGER NOT NULL
);

CREATE TABLE pictures (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  photo_name TEXT NOT NULL,
  photo_ext TEXT NOT NULL,
  user_id INTEGER NOT NULL,
  feature INTEGER NOT NULL,
  description TEXT
);

CREATE TABLE housing(
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER,
  comment TEXT NOT NULL
);

CREATE TABLE listserv (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  email TEXT NOT NULL
);

/* TODO: initial seed data */
INSERT INTO listserv(email) VALUES ('test@cornell.edu');
INSERT INTO listserv(email) VALUES ('123@cornell.edu');
INSERT INTO users (username, password, firstname, lastname, user_status,email,grad_year) VALUES ('cornelluser123', '$2y$10$tmxTw5prlitWlBRQkubj0O/VTMBal52speU/N5qy6Y/cYeotjL8i2', 'cornell', 'user', 1,'test@cornell.edu', 2020);
-- password for cornelluser123 = "ithaca"
INSERT INTO users (username, password, firstname, lastname, user_status, email, grad_year) VALUES
("zehra", "$2y$10$ZKAEHXJNsqHauXMV8ww3AOXV/aR3TicWRGN/Vkj8MUEe2w1hmh0Xa", 'zehra', 'jafri', 2,
   "zj89@cornell.edu", 2020);
-- password for zehra = "stewart" **Zehra is an admin

INSERT INTO housing (user_id, comment) VALUES (1, "Hi. I am a sophomore looking for housing in Collegetown.
  Please email me at test@cornell.edu if you are looking for a roommate who stays up late and is very messy.");
INSERT INTO pictures (photo_name, photo_ext, user_id, feature, description)
VALUES ("PSA1", "jpg", 1, 1, "picture");
INSERT INTO pictures (photo_name, photo_ext, user_id, feature, description)
VALUES ("PSA2", "jpg", 1, 1, "picture");
INSERT INTO pictures (photo_name, photo_ext, user_id, feature, description)
VALUES ("PSA3", "jpg", 1, 1, "picture");

COMMIT;
