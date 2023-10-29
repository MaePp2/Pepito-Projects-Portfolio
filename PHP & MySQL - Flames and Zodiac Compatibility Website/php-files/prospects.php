<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Prospects — Who do you fancy?</title>

        <link rel="stylesheet" type="text/css" href="../styles/prospects.css" />
        <link rel="stylesheet" type="text/css" href="../styles/general.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>
    <body>
        <main id="blur">
            <?php include 'nav.php'?>
            <?php include 'protect.php'?>
            <h1>Prospects</h1>
            <div class="container-button">
                <button type="button" class="add-button" onclick="js:openAddPopup()">Add New Prospect</button>
            </div>
            <table class="content-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Birthday</th>
                        <th>Zodiac</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include 'connect.php';
                        $user_id = $_SESSION["id"];

                        $query = "SELECT * FROM prospect WHERE user_id = ?";

                        $statement = $pdo->prepare($query);
                        $statement->execute([$user_id]);

                        $result = $statement->fetchAll(PDO::FETCH_OBJ); // We can also use PDO::FETCH_ASSOC

                        if($result) {
                            foreach($result as $row) {
                                ?>
                                    <tr>
                                        <td><?php echo $row->id; ?></td>
                                        <td><?php echo $row->first_name; ?></td>
                                        <td><?php echo $row->last_name; ?></td>
                                        <td><?php echo $row->birthday; ?></td>
                                        <td><?php echo $row->zodiac_sign; ?></td>
                                        <td>
                                            <form method="POST">
                                                <a href="?id=<?php echo $row->id; ?>&mode=edit" class="action-icon"><span class="material-symbols-outlined">edit</span></a>
                                                <button class="icon-button" type="submit" name="delete_prospect_btn" value="<?php echo $row->id; ?>">
                                                    <a class="action-icon"><span class="material-symbols-outlined">delete</span></a>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr>
                                <td colspan="6" style="text-align: center;">No Records Found</td>
                            <tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </main>
        <div class="container-popup">
            <div class="popup" id="add-popup">
                <div class="popup__header">
                    <h2>ADD PROSPECT</h2>
                    <a onclick="js:closeAddPopup();" class="close">&times;</a>
                </div>
                <div class="add-prospect">
                    <form action="prospects.php" method="POST">
                        <div class="form__item">
                            <label class="form__label" for="firstname">First name:</label>
                            <input class="form__input" type="text" id="firstname" name="firstname" required="required" />
                        </div>
                        <div class="form__item">
                            <label class="form__label" for="lastname">Last name:</label>
                            <input class="form__input" type="text" id="lastname" name="lastname" required="required" />
                        </div>
                        <div class="form__item">
                            <label class="form__label" for="bday">Birthday:</label>
                            <input class="form__input" type="date" id="bday" name="bday" required="required" />
                        </div>
                        <div class="form__buttons">
                            <button type="reset" class="form__btn reset-button">Reset</button>
                            <button type="submit" name="save_prospect_btn" class="form__btn save-button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-popup">
            <div class="popup" id="edit-popup">
                <?php
                    if(isset($_GET['id'])) {
                        $prospect_id = $_GET['id'];

                        $query = "SELECT * FROM prospect WHERE id = ?";

                        $statement = $pdo->prepare($query);
                        $statement->execute([$prospect_id]);

                        $editResult = $statement->fetch(PDO::FETCH_OBJ); // We can also use PDO::FETCH_ASSOC
                    }
                ?>
                <div class="popup__header">
                    <h2>EDIT PROSPECT</h2>
                    <a onclick="js:closeEditPopup()" class="close">&times;</a>
                </div>
                <div class="add-prospect">
                    <form action="prospects.php" method="POST">
                        <input type="hidden" name="prospectId" value="<?php echo $editResult->id; ?>">
                        <div class="form__item">
                            <label class="form__label" for="firstname">First name:</label>
                            <input value="<?php if (!empty($editResult)) { echo $editResult->first_name; } ?>" class="form__input" type="text" id="firstname" name="firstname" required="required" />
                        </div>
                        <div class="form__item">
                            <label class="form__label" for="lastname">Last name:</label>
                            <input value="<?php if (!empty($editResult)) { echo $editResult->last_name; } ?>" class="form__input" type="text" id="lastname" name="lastname" required="required" />
                        </div>
                        <div class="form__item">
                            <label class="form__label" for="bday">Birthday:</label>
                            <input class="form__input" type="date" value="<?php if (!empty($editResult)) { echo $editResult->birthday; } ?>" id="bday" name="bday" required="required" />
                        </div>
                        <div class="form__buttons">
                            <button type="reset" class="form__btn reset-button">Reset</button>
                            <button type="submit" name="update_prospect_btn" class="form__btn save-button">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php
            class Person {
                // Person Attributes
                public $first_name;
                public $last_name;
                public $birthday;
                public $zodiac_sign;

                // Person Constructor that takes in first_name, last_name, birthday, and pdo connection
                public function __construct($first_name, $last_name, $birthday, $pdo) {
                    $this-> first_name = $first_name;
                    $this-> last_name = $last_name;
                    $this-> birthday = $birthday;

                    //convert prospect birthday separate m and d date formats
                    $month = date("m", strtotime($birthday));
                    $day = date("d", strtotime($birthday));

                    // Prepare and execute the select statement
                    $sql = "SELECT * FROM zodiac";
                    if($stmt = $pdo->prepare($sql)) {
                        if($stmt->execute()) {
                            // Fetch all rows of the table
                            $zodiac = $stmt->fetchAll();
                            
                            //iterate through all rows of the zodiac table
                            foreach($zodiac as $zodiac) {
                                //convert start and end date to time
                                $startDate = $zodiac['start_date'];
                                $endDate = $zodiac['end_date'];

                                //convert startDate and endDate into separate m and d date formats
                                $startMonth = date("m", strtotime($startDate));
                                $startDay = date("d", strtotime($startDate));

                                $endMonth = date("m", strtotime($endDate));
                                $endDay = date("d", strtotime($endDate));
                                
                                //check if prospect_birthday is between the start Date and end Date
                                if (($month == $startMonth && $day >= $startDay) || ($month == $endMonth && $day <= $endDay)) {        
                                //echo $zodiac['zodiac_id'] . ' ' . $zodiac['zodiac_sign'] . ' ' . $zodiac['symbol'] . ' ' . $zodiac['start_date'] . ' ' . $zodiac['end_date'] . ' ' . '<br>'; //testing
                                    $this->zodiac_sign = $zodiac['zodiac_sign'];
                                }
                            }
                        }
                    }
                }
            }

            if(isset($_POST['save_prospect_btn'])) {
                $person = new Person($_POST['firstname'], $_POST['lastname'], $_POST['bday'], $pdo);

                $firstname = $person->first_name;
                $lastname = $person->last_name;
                $birthday = $person->birthday;
                $zodiac = $person->zodiac_sign;

                $query = "INSERT INTO prospect (first_name, last_name, birthday, zodiac_sign, user_id) VALUES (?, ?, ?, ?, ?)";
                $query_run = $pdo->prepare($query);

                $data = [$firstname, $lastname, $birthday, $zodiac, $_SESSION["id"]];

                $query_execute = $query_run->execute($data);

                if($query_execute) {
                    $_SESSION['message'] = "Inserted Successfully";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                } else {
                    $_SESSION['message'] = "Failed to Insert";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                }
            }

            if(isset($_POST['update_prospect_btn'])) {
                $person = new Person($_POST['firstname'], $_POST['lastname'], $_POST['bday'], $pdo);

                $prospect_id = $_POST['prospectId'];
                $firstname = $person->first_name;
                $lastname = $person->last_name;
                $birthday = $person->birthday;
                $zodiac = $person->zodiac_sign;

                $query = "UPDATE prospect SET first_name = ?, last_name=?, birthday=?, zodiac_sign=? WHERE id = ?";
                $query_run = $pdo->prepare($query);

                $data = [$firstname, $lastname, $birthday, $zodiac, $prospect_id];

                $query_execute = $query_run->execute($data);

                if($query_execute) {
                    $_SESSION['message'] = "Updated Successfully";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                } else {
                    $_SESSION['message'] = "Failed to Update";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                }
            }
           
            if(isset($_POST['delete_prospect_btn'])) {
                $prospect_id = $_POST['delete_prospect_btn'];

                $query = "DELETE FROM prospect WHERE id = ?";
                $query_run = $pdo->prepare($query);

                $data = [$prospect_id];

                $query_execute = $query_run->execute($data);

                if($query_execute) {
                    $_SESSION['message'] = "Deleted Successfully";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                } else {
                    $_SESSION['message'] = "Failed to Delete";
                    Print '<script>window.location.assign("prospects.php");</script>'; // redirects to prospects.php
                    exit(0);
                }
            }
        ?>
    <script>
        let add_popup = document.getElementById("add-popup");
        let edit_popup = document.getElementById("edit-popup");

        function openAddPopup() {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var unBlurPopup = document.getElementById('add-popup');
            unBlurPopup.classList.toggle('active');

            add_popup.classList.add("open-popup");
        }

        function openEditPopup() {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var unBlurPopup = document.getElementById('edit-popup');
            unBlurPopup.classList.toggle('active');

            edit_popup.classList.add("open-popup");
        }

        function closeAddPopup() {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var unBlurPopup = document.getElementById('add-popup');
            unBlurPopup.classList.toggle('active');

            add_popup.classList.remove("open-popup");
        }

        function closeEditPopup() {
            var blur = document.getElementById('blur');
            blur.classList.toggle('active');
            var unBlurPopup = document.getElementById('edit-popup');
            unBlurPopup.classList.toggle('active');

            edit_popup.classList.remove("open-popup");
        }

        window.onload = function() {
            var url = window.location.href;
            var mode = url.substring(url.lastIndexOf('&')+1);

            if (mode == "mode=edit") {
                openEditPopup();
            }
        };
    </script>
    </body>
</html>