# github-search


### Requiriments 

##### LAMP Server configurated 
- PHP 7.1 
- MySQL or MariaDB 
- Apache Server 
- Nodejs
- NPM

#### MySQL Setup

Setup `/api/bdd/config.php` with your credentials MySQL Server 

```php
<?php 
    $USERNAME = 'SECRET_USERNAME';
    $PASSWORD = 'SECRET_PASSWORD';
    $DATABASE = 'YOUR_DATABASE';
    $HOST = 'YOUR_HOST';
?>
```

#### Create Database 

```sql

CREATE DATABASE YOUR_DATABASE;

USE YOUR_DATABASE;

CREATE TABLE log_searchs(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	created_date datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	search_query varchar(100) NOT NULL
);

```

#### Install Repo on Server 

###### Download repo
```
git clone https://github.com/henryraygan/github-search.git && mv github-search /var/www/html
```
use sudo if necessary

#### Run dev 

```bash 
cd dev/web/ && npm run serve
```

#### Build 

```bash 
npm run build
```

#### Build for server
Clean folder *public/* and prepare new files for the move to root directory server 

```bash 
npm run build:prepareddeploy
```

#### Acces to web

<http://localhost/github-search/>

