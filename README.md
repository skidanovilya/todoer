# Todoer
This is simple app built on poore php specialy for test task
### Installation
To install using composer 

```bash
$ cd /var/www/
$ git clone ###
$ composer update
```

Also you need to create simple MySQL Database

Create install file `install.sql`and pass to it this code:

    CREATE  TABLE tasks (
    	id INT  NOT  NULL  PRIMARY  KEY  AUTO_INCREMENT,
    	name  VARCHAR(255) NOT  NULL,
    	email VARCHAR(255) NOT  NULL,
    	body TEXT  NOT  NULL,
    	completed BOOLEAN  DEFAULT  0
    	modified BOOLEAN  DEFAULT  0
    );
    
    CREATE  TABLE users (
    	id INT  NOT  NULL  PRIMARY  KEY  AUTO_INCREMENT,
    	login  VARCHAR(255) NOT  NULL,
    	password  VARCHAR(255) NOT  NULL
    );
    
    INSERT  INTO users (login, password) VALUES ('admin', 'admin'); 

And run this script

    $ mysql -u USER -p DB_NAME < install.sql
To setup Apache Server

    $ sudo nano /etc/apache2/sites-available/todoer.conf

Pass to it next contents

    <VirtualHost *:80>
	    ServerName localhost
        DocumentRoot /var/www/public_html
        <Directory /var/www/public_html>
            Options Indexes FollowSymLinks
            AllowOverride None
            Require all granted
        </Directory>
    </VirtualHost>

And run this commands

    $ sudo a2ensite todoer
    $ sudo systemctl reload apache2

To check your web site visit `localhost/` in your browser