CREATE TABLE users(
  userID INT NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  privKey VARCHAR(4096) NOT NULL,
  pubKey VARCHAR(4096) NOT NULL,
  PRIMARY KEY (userID)
);

CREATE TABLE userscontacts(
  low INT NOT NULL,
  high INT NOT NULL
);

