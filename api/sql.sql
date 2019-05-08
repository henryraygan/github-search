SHOW TABLES;

CREATE TABLE log_searchs(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	search_query varchar(10) NOT NULL
);
	
SELECT * FROM log_searchs;