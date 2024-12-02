<?php
require_once '../admin/inc/db_config.php'; //Include database connection
require_once '../inc/input_helpers.php'; //Include to use sanitization helpers

/**
 * Authenticates a user based on email and password.
 *
 * @param string $email: The user's email.
 * @param string $password: The user's password.
 * @param array &$errors: Array to store any error messages.
 * @return int|false Returns the user ID on success or false on failure.
 * 
 * @link https://www.php.net/manual/en/function.password-verify.php - password_verify()
 * @see MyWebsite/inc/input_helpers - clean_input()
 */
function authenticate_user($email, $password, &$errors) {
    global $con; //Database connection from db_config.php

    //Sanitize email
    $email = clean_input('email', $email);

    //Validate inputs
    if (empty($email)) {
        $errors['email'] = "Email is required, this field cannot be empty.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format, please check that the email has the correct format - e.g. user@example.no.";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required, this field cannot be empty.";
    }

    //If no validation errors, proceed with checking the user
    if (empty($errors)) {
        //Prepare the SQL query to fetch hashed_password for the given mail
        $sp = $con->prepare("SELECT email, hashed_password FROM users WHERE email = ?");
        $sp->bind_param("s", $email); //Bind the email to the query
        $sp->execute();
        $result = $sp->get_result();

        //If email does not exist in the database
        if ($result->num_rows === 0) {
            $errors['login'] = "Incorrect email or password.";
            $sp->close();
            return false;
        }
        //Fetch user data
        $user = $result->fetch_assoc();
        $hashed_password = $user['hashed_password'];  //Get the hashed password from the database

        //Verify inputted password with hashed password stored in the database
        if (!password_verify($password, $hashed_password)) {
            $errors['login'] = "Incorrect email or password.";
            $sp->close();
            return false;
        }

        // If login is successful, close the prepared statement and return true
        $sp->close();
        return true;
    }

    return false; //Return false if there are validation errors
}


?>