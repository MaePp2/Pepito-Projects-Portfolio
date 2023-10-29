<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account — Compatibility Test</title>

        <link rel="stylesheet" type="text/css" href="../styles/general.css" />
        <link rel="stylesheet" type="text/css" href="../styles/form.css" />
    </head>
    <body>
        <?php include 'nav.php'?>
        <section>
            <div class="answer-form">
                <h1>My Account</h1>
                <form action="login.php" method="POST">
                    <div class="form-field">
                        <label hidden for="user-email">Email:</label>
                        <input placeholder="EMAIL" type="email" id="user-email" name="user-email" readonly onfocus="this.removeAttribute('readonly');" required="required" />
                    </div>
                    <div class="form-field">
                        <label hidden for="user-pw">Password:</label>
                        <input placeholder="PASSWORD" type="password" id="user-pw" name="user-pw" required="required" />
                    </div>
                    <div class="form-links">
                        <a href="register.php" class="form-link">New Here? Sign Up</a>
                        <button class="submit-button" value="Log In">Log In</button>
                    </div>
                </form>
            </div>
        </section>
    </body>
</html>

<?php
    include 'connect.php';

    if(isset($_POST['user-email'])) {
        $email = ($_POST['user-email']); // checking and retrieving email
        $password = ($_POST['user-pw']);

        // Retrieve one record that matches the email
        // Check the password hash
        // Store data in a session
        // Preparing the query so that hacking the database becomes difficult

        $query = 'SELECT * FROM system_user WHERE email = ?';
        $values = [$email];

        try {
            $res = $pdo->prepare($query);
            $res->execute($values);
        } catch (PDOException $e) {
          /* Query error. */
          echo 'Query error.';
          die();
        }   

        $row = $res->fetch(PDO::FETCH_ASSOC);
        /* If there is a result, check if the password matches using password_verify(). */
        if (is_array($row)) {
            if (password_verify($password, $row['password'])){
                /* The password is correct. */
                $_SESSION["email"] = $email;
                $_SESSION["id"] = $row["id"];
                $_SESSION["logged_in"] = true;
                header('location:home.php');
            } else {
                //if the number of rows is not one then show this message
                setcookie("error", "Wrong username or password", time()+3);
            }
        } else {
            //if the password provided by user and hash do not match
            setcookie("error", "Wrong username or password", time()+3);
        }
    }
?>