Simplogin
=========

A very simple login class written in PHP with MySQLi (OO!)

# Installation
To start we need to include the class itself. You can do this by writing:

    <?php
    require 'classes/simplogin.class.php';
    
Now we need to load the class, and initialize it:

    <?php
    $simplogin = new Simplogin('db_host', 'db_user', 'db_password', 'db', 'Hash', 'salt');
    
You'll need to edit the parameters yourself, I recommend using SHA512 as the hash and a 32 characters salt.

Now that you've initialized the class, you'll have to import the SQL. The SQL code is:

    -- 
    -- Structure for table `users`
    -- 
    
    DROP TABLE IF EXISTS `users`;
    DROP TABLE IF EXISTS `users`;
		CREATE TABLE IF NOT EXISTS `users` (
		`id` int(12) NOT NULL AUTO_INCREMENT,
		`username` varchar(255) NOT NULL,
		`password` varchar(128) NOT NULL,
		`last_ip` varchar(15) NOT NULL,
		`last_login` int(10) NOT NULL,
		PRIMARY KEY (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    
    -- 
    -- Data for table `users`
    -- 
    
    INSERT INTO `users` (`id`, `username`, `password`, `last_ip`, `last_login`) VALUES
      ('1', 'username', '9055ecf4267bdb4476e2c2e84fd375bdf176244bccbbbe1beb87917dda3fb0962ee3232774b5b5a1723f9803be60af5e63bcd8613c5ebd6b05697e253d98f258', '10.127.2.10', '1375550966');

The setup is now complete, although the created account uses the SHA-512 hash so it will not work with any other hash!

The username is 'username' and the password = 'password'.
# Using the class
Also this is very easy to do, you'll have to call a method and add 2 parameters to it. That's it. The parameters can be multiple things, for example you could use a POST for the username and a GET for the password. the choice is yours!

    $simplogin->check('username', 'password');
    $simplogin->check($_POST['username'], $_POST['password']);
    
# So how can I make a login from this?
Just add an if statement! Simple as that, the class returns true if the information could be found and it returns false if not. Also when a user has logged in succefully it will insert a timestamp and IP-address into the database. This could be useful when you're making a logging system.

Example using an if statement:

    if ($simplogin->check('username', 'password') == true)
    {
        echo 'Credentials were valid!';
    }
    else
    {
        echo 'I\'m sorry, but the credentials are invalid.';
    }
    
### There's also an example.php in the repo, so you can use that if you still don't understand how it works.
