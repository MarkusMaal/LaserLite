-- Live stream schedules
CREATE TABLE schedules (
	ID int AUTO_INCREMENT,
	ename varchar(255) NOT NULL, -- Name of the event
	etime datetime NOT NULL, -- Time of the event
	echannel VARCHAR(64) NOT NULL, -- Channel, where the event is broadcast
	eurl VARCHAR(64) DEFAULT NULL, -- URL for the event
	PRIMARY KEY(ID)
);
-- Old comment system/unused poll system (e stands for English, the other one should be in Estonian)
CREATE TABLE poll_e (
	question TEXT,
	options TEXT,
	last_vote_date DOUBLE NOT NULL,
	close TEXT,
	public TEXT,
	id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id)
);

CREATE TABLE poll (
	question TEXT,
	options VARCHAR(250) DEFAULT NULL,
	close TEXT,
	public INT NOT NULL,
	last_vote_date DOUBLE DEFAULT NULL,
	id INT NOT NULL AUTO_INCREMENT,
	PRIMARY KEY (id)
);

-- Markus' stuff database
CREATE TABLE mas_db (
	ID INT NOT NULL AUTO_INCREMENT,
	VERSIOON FLOAT NOT NULL,
	LVERSIOON FLOAT NOT NULL,
	AASTA YEAR(4) NOT NULL,
	NIMI VARCHAR(255) NOT NULL,
	KIRJELDUS VARCHAR(4096) NOT NULL,
	MINI TINYINT(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(ID)
);

CREATE TABLE mas_wallpapers (
	ID INT NOT NULL AUTO_INCREMENT,
	ASUKOHT VARCHAR(255) NOT NULL,
	VERSIOONI_ID INT NOT NULL,
	PRIMARY KEY(ID),
	FOREIGN KEY(VERSIOONI_ID) REFERENCES mas_db(ID)
);

-- Management accounts
CREATE TABLE managers (
	ID INT NOT NULL AUTO_INCREMENT,
	UNAME VARCHAR(20) NOT NULL, -- Username
	UPASS VARCHAR(100) NOT NULL, -- Password key
	ISOWNER TINYINT(1) NOT NULL DEFAULT 0, -- If 1, the account has owner priviledges
	ISADMIN TINYINT(1) DEFAULT 0, -- If 1, the account has administrator priviledges
	RECOVER_VERIFY TINYINT(1) DEFAULT 0, -- If 1, the account password has been reset
	RECOVERYCODE INT NOT NULL, -- Recovery code for resetting the password
	PRIMARY KEY(ID)
);

-- Comments
CREATE TABLE general_comments (
	ID INT NOT NULL AUTO_INCREMENT,
	NAME VARCHAR(255) NOT NULL, -- Username for one who posted the comment
	COMMENT VARCHAR(1024) NOT NULL, -- The contents of the comment
	THREAD INT NOT NULL, -- Thread values: 1 - Blog post comments, 2 - Download comments, 3 - Channel database comments, 4 - Private messages/Feedback
	REPLY TINYINT(1) NOT NULL DEFAULT 0, -- If 1, the comment is actually a reply
	REPLY_PARENT INT DEFAULT NULL, -- In case we're replying to someone, reference their ID here
	PAGE_ID INT NOT NULL, -- Reference to the page we're writing the comment to (can vary depending on THREAD value)
	likes INT DEFAULT NULL, -- Number of likes (mainly for use in channel database)
	dislikes INT DEFAULT 0, -- Number of dislikes (mainly for use in channel database)
	heart TINYINT(1) DEFAULT 0, -- If 1, the comment has a heart, added by the owner
	hide TINYINT(1) DEFAULT 0, -- If 1, the comment has been hidden and is only visible to moderators/admins/owners
	PRIMARY KEY(ID)
);

-- Comment managers (table for storing the password for an anonymous comment)
CREATE TABLE comment_managers (
	id INT NOT NULL AUTO_INCREMENT,
	cid INT NOT NULL, -- Comment ID reference
	code VARCHAR(255) NOT NULL, -- Password key for comment management
	PRIMARY KEY(id),
	FOREIGN KEY (cid) REFERENCES general_comments(ID)
);

-- Likes and dislikes left to comments by website visitors
CREATE TABLE client_ratings (
	ID INT NOT NULL AUTO_INCREMENT,
	CLIENT VARCHAR(255) NOT NULL, -- Client token. This is a has, generated using IP and browser session ID
	CID INT NOT NULL, -- Comment ID reference
	POSITIVE TINYINT(1) NOT NULL DEFAULT 0, -- If 1, it's a like, if 0, it's a dislike
	PRIMARY KEY(ID),
	FOREIGN KEY (CID) REFERENCES general_comments(ID)
);

-- Unused account system
CREATE TABLE accounts (
	userid INT NOT NULL,
	username VARCHAR(32) NOT NULL,
	bio VARCHAR(256) NOT NULL,
	passwd VARCHAR(128) NOT NULL,
	picture VARCHAR(128) NOT NULL,
	PRIMARY KEY(userid)
);

-- Unused guest book system
CREATE TABLE gbook (
	comment_id INT NOT NULL AUTO_INCREMENT,
	usr_id INT NOT NULL,
	txt VARCHAR(1000) NOT NULL,
	postdate DATETIME NOT NULL,
	FOREIGN KEY(usr_id) REFERENCES accounts(userid),
	PRIMARY KEY(comment_id)
);

-- Login verification details for the feedback section
CREATE TABLE feedback_users (
	ID INT NOT NULL AUTO_INCREMENT,
	CRYPTCODE VARCHAR(128) NOT NULL, -- Verification code (generated based on username and password)
	PRIMARY KEY(ID)
);

-- English blog posts
CREATE TABLE eblog (
	id INT NOT NULL AUTO_INCREMENT,
	post_time TIMESTAMP NOT NULL DEFAULT current_timestamp(), -- Date and time when the blog post was published on the website
	title TEXT NOT NULL, -- Title of the blog post
	body TEXT NOT NULL, -- Contents of the blog post
	KEY(ID)
);

-- Estonian blog posts (see English blog posts for details)
CREATE TABLE blog (
	id INT NOT NULL AUTO_INCREMENT,
	post_time TIMESTAMP NOT NULL DEFAULT current_timestamp(),
	title TEXT NOT NULL,
	body TEXT NOT NULL,
	KEY(id)
);

-- Downloads
CREATE TABLE dloads (
	ID INT NOT NULL AUTO_INCREMENT,
	DTYPE INT NOT NULL, -- Download category (1 - Batch files, 2 - PowerPoint, 3 - Software, 4 - Wallpapers, 5 - Other)
	DTITLE VARCHAR(255) NOT NULL, -- Download title
	DDESC VARCHAR(4096) NOT NULL, -- Download description
	MUI_DTITLE VARCHAR(255) NOT NULL, -- Download title (in English)
	MUI_DDESC VARCHAR(1024) NOT NULL, -- Download description (in English)
	PRIMARY KEY(ID)
);

-- Screenshots for the downloads
CREATE TABLE dscrnshots (
	ID INT NOT NULL AUTO_INCREMENT,
	URI VARCHAR(255) NOT NULL, -- URI for the image
	DLOAD INT NOT NULL, -- Download ID reference
	PRIMARY KEY(ID),
	FOREIGN KEY (DLOAD) REFERENCES dloads(ID)
);

-- Links for the downloads
-- Separate table, because I may want to add mirror links to the same download
CREATE TABLE dlinks (
	ID INT NOT NULL AUTO_INCREMENT,
	LINK_URI VARCHAR(255) NOT NULL, -- URL for the download link
	LINK_PRIMARY TINYINT(1) DEFAULT 0, -- If 1, the link is the primary link, otherwise it's a mirror link
	CHKSUM VARCHAR(128) NOT NULL, -- Checksum for the downloadable file
	DLOAD INT NOT NULL, -- Download ID reference
	PRIMARY KEY(ID),
	FOREIGN KEY (DLOAD) REFERENCES dloads(ID)
);

-- Channel database
CREATE TABLE channel_db (
	ID INT NOT NULL AUTO_INCREMENT,
	Kanal VARCHAR(64) NOT NULL,
	Video VARCHAR(256) NOT NULL,
	Kustutatud TINYINT(1) NOT NULL DEFAULT 0,
	Kuupäev DATE NOT NULL,
	Kirjeldus VARCHAR(4096) NOT NULL,
	Subtiitrid TINYINT(1) NOT NULL DEFAULT 0,
	Avalik TINYINT(1) NOT NULL DEFAULT 1,
	Ülekanne TINYINT(1) NOT NULL DEFAULT 0,
	HD TINYINT(1) NOT NULL DEFAULT 1,
	URL VARCHAR(50) NOT NULL DEFAULT 'pole täpsustatud',
	PRIVATE TINYINT(1) DEFAULT 0, -- If this is set to 1, the record should not be publically visible
	PRIMARY KEY(ID)
);

-- Channel gallery
CREATE TABLE channel_gallery (
	ID INT NOT NULL AUTO_INCREMENT,
	Kanal VARCHAR(255) NOT NULL,
	Kirjeldus VARCHAR(4096) NOT NULL,
	Loomiskuupäev DATE NOT NULL,
	URL VARCHAR(255) DEFAULT NULL,
	Kustutatud TINYINT(1) DEFAULT NULL,
	PRIMARY KEY (ID)
);

-- Channel idea box
CREATE TABLE channel_ideas (
	id INT NOT NULL AUTO_INCREMENT,
	Kanal VARCHAR(128) DEFAULT NULL,
	Video VARCHAR(255) DEFAULT NULL,
	Valmis TINYINT(1) DEFAULT NULL,
	Kirjeldus VARCHAR(2048) DEFAULT NULL,
	Klass SMALLINT(6) DEFAULT NULL,
	Ülekanne TINYINT(1) DEFAULT 0,
	PRIMARY KEY (id)
);

-- Changelog dates
CREATE TABLE changelog (
	ID INT NOT NULL AUTO_INCREMENT,
	RELEASEDATE DATE NOT NULL, -- A date for storing multiple changes in a changelog
	FIRSTLOG TINYINT(1) DEFAULT 0, -- If this is set to 1, it's categories into the "Older changes" category
	PRIMARY KEY (ID)
);

-- Changes in the changelog
CREATE TABLE changelog_change (
	ID INT NOT NULL AUTO_INCREMENT,
	PARNT_ID INT NOT NULL, -- Reference to the changelog date
	CONTENT_ET VARCHAR(255) NOT NULL, -- The contents of the change in Estonian
	CONTENT_EN VARCHAR(255) NOT NULL, -- The contents of the change in English
	PRIMARY KEY (ID),
	FOREIGN KEY (PARNT_ID) REFERENCES changelog(ID)
);

-- Populate DB with defaults (required to manage the website)


-- To log into the website after importing this DB, do the following:
-- 1. Open the website, accept cookies
-- 2. Click on the gear icon at the bottom left
-- 3. Click "Log in"
-- 4. As the username, enter "admin", leave the password field empty
-- 5. Click "Log in"
-- 6. Enter 3366110 as the verification code and set a password you're going to use to log in
-- 7. You'll be logged out. Log in with "admin" as the username and as the password use the one
--    you just set.
-- 8. Click "Log in" (again)
-- 9. You are now logged in as the owner. You can use this account to do various things, including adding other accounts
--    and modifying the content on the website.
-- 10. Note that you are not able to use the recovery code to log in anymore, you have to use the password (unless you
--     set RECOVER_VERIFY to 1 on the database directly
INSERT INTO managers (UNAME, UPASS, ISOWNER, ISADMIN, RECOVER_VERIFY, RECOVERYCODE) VALUES (
	'admin',
	'',
	1,
	1,
	1,
	3366110
)
