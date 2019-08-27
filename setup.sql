create database lab_project;
use lab_project;

CREATE TABLE Game
(
    Game_ID INTEGER NOT NULL AUTO_INCREMENT,
    Title VARCHAR(70) NOT NULL,  
    Game_Type VARCHAR(30) NOT NULL,   
    Release_Year Integer NOT NULL, 
    Platform VARCHAR(40) NOT NULL,
    Artwork_Name VARCHAR(200) NOT NULL,
    Price Integer NOT NULL,
    Description VARCHAR(700),
    PRIMARY KEY (Game_ID), 
    UNIQUE (Game_ID)
);
CREATE TABLE Member 
(
    Member_ID INTEGER NOT NULL AUTO_INCREMENT, 
    Member_Name VARCHAR(100) NOT NULL,
    Member_Email VARCHAR(100) NOT NULL,
    Member_Contact VARCHAR(100) NOT NULL,
    Banned_Until DATE NULL,
    PRIMARY KEY (Member_ID), 
    UNIQUE (Member_ID)
);
CREATE TABLE Rental 
(
    Rental_ID INTEGER NOT NULL AUTO_INCREMENT, 
    Game_ID INTEGER NOT NULL,
    Member_ID INTEGER NOT NULL,   
    Start_Date DATE NOT NULL,
    Return_Date DATE NOT NULL, 
    Extended_Until DATE NULL,
    Date_Returned DATE NULL,
    Return_Condition VARCHAR(40) DEFAULT 'Pending',
    Fee INTEGER,
    Paid INTEGER DEFAULT 0,
    PRIMARY KEY (Rental_ID), 
    UNIQUE (Rental_ID),
    FOREIGN KEY (Game_ID) REFERENCES Game(Game_ID) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (Member_ID) REFERENCES Member(Member_ID) ON DELETE CASCADE ON UPDATE CASCADE

);
CREATE TABLE Staff 
(
    Staff_ID INTEGER NOT NULL AUTO_INCREMENT, 
    Staff_Name VARCHAR(100) NOT NULL, 
    Username VARCHAR(240) NOT NULL, 
    Hashed_Password VARCHAR(255) NOT NULL, 
    Privilege VARCHAR(100) NOT NULL,
    PRIMARY KEY (Staff_ID), 
    UNIQUE (Staff_ID)
);
CREATE TABLE Rules
(
    Rule_ID INTEGER NOT NULL AUTO_INCREMENT,
    Rule VARCHAR(65533) NOT NULL,
    PRIMARY KEY (Rule_ID), 
    UNIQUE (Rule_ID)
);