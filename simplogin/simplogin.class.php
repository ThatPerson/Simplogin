<?php
class Simplogin {
    function __construct($host, $user, $password, $database, $hash, $salt)
    {
        // Connect to the database
        @$db = new mysqli($host, $user, $password, $database);

        if ($db->connect_error) {
            die('Database connection failed!');
        }
        
        // Setup all the information for the class
        $this->db = $db;
        $this->hash = $hash;
        $this->salt = $salt;
        $this->ip = $_SERVER['REMOTE_ADDR'];
        $this->time = time();

    }
    function check($username = false, $password = false)
    {
        // Escape the input
        $username = $this->db->real_escape_string($username);
        $password = $this->db->real_escape_string($password);
        
        // Hash the password
        $password = hash($this->hash, $this->salt.$password);
        
        // Execute the query
        $query = $this->db->query("
                                    SELECT username, password
                                    FROM users
                                    WHERE username = '$username' AND password = '$password'
                                  ");
        
        // Send true or false
        if ($query->num_rows == 1)
        {
            // Since the result is true, update the database information
            $this->db->query("
                                UPDATE users
                                SET last_ip = '$this->ip', last_login = '$this->time'
                                WHERE username = '$username'
                             ");
            return true;
        }
        else
        {
           return false;
        }
    }
}