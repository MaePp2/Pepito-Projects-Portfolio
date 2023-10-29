<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account — Compatibility Test</title>
        
        <link rel="stylesheet" type="text/css" href="../styles/general.css" />
        <link rel="stylesheet" type="text/css" href="../styles/form.css" />
    </head>
    <body>
        <?php include 'nav.php'?>
        <section>
            <div class="answer-form">
                <h1>New Account</h1>
                <form action="register.php" method="POST">
                    <div class="form-field">
                        <label hidden for="user-firstname">First name:</label>
                        <input placeholder="FIRST NAME" type="text" id="user-firstname" name="user-firstname" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-lastname">Last name:</label>
                        <input placeholder="LAST NAME" type="text" id="user-lastname" name="user-lastname" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-bday">Birthday:</label>
                        <input placeholder="BIRTHDAY" onfocus="(this.type='date')" type="text" id="user-bday" name="user-bday" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-street1">Street Line 1:</label>
                        <input placeholder="STREET LINE 1" type="text" id="user-street1" name="user-street1" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-street2">Street Line 2:</label>
                        <input placeholder="STREET LINE 2" type="text" id="user-street2" name="user-street2" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-city">City:</label>
                        <input placeholder="CITY" type="text" id="user-city" name="user-city" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-state">State or Province:</label>
                        <input placeholder="STATE OR PROVINCE" type="text" id="user-state" name="user-state" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-email">Email:</label>
                        <input placeholder="EMAIL" type="email" id="user-email" name="user-email" readonly onfocus="this.removeAttribute('readonly');" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-pw">Password:</label>
                        <input placeholder="PASSWORD" type="password" id="user-pw" name="user-pw" required="required" />
                    </div>
                    <div class="form-links">
                        <a href="login.php" class="form-link">Have an Account? Log In</a>
                        <button class="submit-button">Create Account</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>

<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $firstName = ($_POST['user-firstname']);
        $lastName = ($_POST['user-lastname']);
        $birthday = ($_POST['user-bday']);
        $streetLine1 = ($_POST['user-street1']);
        $streetLine2 = ($_POST['user-street2']);
        $city = ($_POST['user-city']);
        $state = ($_POST['user-state']);
        $email = ($_POST['user-email']);
        $password = ($_POST['user-pw']);
        $password = password_hash($password, PASSWORD_DEFAULT); // Encrypting the password
        date_default_timezone_set('Asia/Manila');
        $dateCreated = date('y-m-d h:i:s');

        $bool = true;
        
        include 'connect.php';

        $stmt = $pdo->query("SELECT * FROM system_user");
        while ($row = $stmt->fetch())
        {
            $table_users = $row['email']; // The first email row is passed on to $table_users, and so on until the query is finished
            if($email == $table_users) { // Checks if there are any matching fields
                $bool = false; // Sets bool to false
                Print '<script>alert("Email has been taken!");</script>'; // Prompts the user
                Print '<script>window.location.assign("register.php");</script>'; // Redirects to register.php
            }
        }
        if($bool) { // checks if bool is true
                $stmt = $pdo->prepare('INSERT INTO system_user (first_name, last_name, birthday, street_line_1, street_line_2, city, state, email, password, date_created) VALUES
                (?,?,?,?,?,?,?,?,?,?)');
                $stmt->execute([$firstName,$lastName,$birthday,$streetLine1,$streetLine2,$city,$state,$email,$password,$dateCreated]);
                $user = $stmt->fetch();
                Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
                Print '<script>window.location.assign("login.php");</script>'; // Redirects to home.php
            }
    }
?>