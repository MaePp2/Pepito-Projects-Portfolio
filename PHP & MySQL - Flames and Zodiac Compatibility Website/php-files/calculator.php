<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Calculator — Are you Compatible?</title>
        
        <link rel="stylesheet" type="text/css" href="../styles/general.css" />
        <link rel="stylesheet" type="text/css" href="../styles/calculate.css" />
    </head>
    <body>
        <?php include 'nav.php'?>
        <?php include 'protect.php'?>
        <h1>Calculator</h1>
        <section>
            <div class="calculate-form">
                <form action="calculator.php" method="POST">
                    <?php
                        include 'connect.php';
                        $user_id = $_SESSION["id"];

                        $query = "SELECT * FROM prospect WHERE user_id = ?";

                        $statement = $pdo->prepare($query);
                        $statement->execute([$user_id]);

                        $result = $statement->fetchAll(PDO::FETCH_OBJ); // We can also use PDO::FETCH_ASSOC
                    ?>
                    <div class="form-field-1">
                        <label for="person-1">Person 1:</label>
                        <select class="select" id="person-1" name="person-1" required="required">
                            <?php foreach ($result as $output) { ?>
                            <option><?php echo $output->first_name; ?></option>
                            <?php } ?>
                        </select>
                    <div class="form-field-2">
                        <label for="person-2">Person 2:</label>
                        <select class="select" id="person-2" name="person-2" required="required">
                            <?php foreach ($result as $output) { ?>
                            <option><?php echo $output->first_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form__buttons">
                        <button type="reset" class="form__btn reset-button" value="Calculate">Reset</button>
                        <button type="submit" name="calculate_btn" class="form__btn calculate-button" value="Calculate">Calculate</button>
                    </div>
                </form>
            </div>
        </section>
        <section>
            <div class="section--results">
                <?php
                    if(isset($_POST['calculate_btn'])) {
                        $user_id = $_SESSION["id"];
                        $person1 = $_POST['person-1'];
                        $person2 = $_POST['person-2'];
        
                        $query = "SELECT * FROM prospect WHERE user_id = ? AND first_name = ?";
                        $query_run = $pdo->prepare($query);

                        $data1 = [$user_id, $person1];
                        $data2 = [$user_id, $person2];
                        
                        $query_run->execute($data1);

                        $result1 = $query_run->fetch(PDO::FETCH_OBJ);
        
                        //store first person first name and last name attributes 
                        $firstName1 = $result1->first_name;
                        $lastName1 = $result1->last_name;
                        $zodiacSign1 = $result1->zodiac_sign;

                        $query_run->execute($data2);

                        $result2 = $query_run->fetch(PDO::FETCH_OBJ);

                        //store second person first name and last name attributes 
                        $firstName2 = $result2->first_name;
                        $lastName2 = $result2->last_name;
                        $zodiacSign2 = $result2->zodiac_sign;
                    
                        //concatenate names, remove non-alphanumeric characters from the string, and store converted lowercase fullnames for correct comparison of common letters
                        $person1FullName = strtolower(preg_replace('/[^a-zA-Z0-9]/','', $firstName1. $lastName1));
                        $person2FullName = strtolower(preg_replace('/[^a-zA-Z0-9]/','', $firstName2. $lastName2));
                    
                        //store characters of fullnames in an array without duplicates
                        $person1NameCharacters = array_unique(str_split($person1FullName));
                        $person2NameCharacters = array_unique(str_split($person2FullName));
                    
                        //store common characters in an array
                        $commonChars = array_intersect($person1NameCharacters, $person2NameCharacters);
                    
                        //re-order keys
                        $commonChars = array_values($commonChars);
                    
                        //initialize counter variables to 0
                        $indexCnt = 0;
                        $commonCharacterCount = 0;
                    
                        //loop size-of-common-characters-array times
                        while($indexCnt < count($commonChars)){
                            //count the number of instances the current character is found in person 1's full name
                            $newcount = substr_count("$person1FullName","$commonChars[$indexCnt]");
                            //update counter variable
                            $commonCharacterCount = $newcount + $commonCharacterCount;
                            //count the number of instances the current character is found in person 2's full name
                            $newcount = substr_count("$person2FullName","$commonChars[$indexCnt]");
                            //update counter variable
                            $commonCharacterCount = $newcount + $commonCharacterCount;
                            //increment counter to go to the next character in the common-characters array
                            $indexCnt++;
                        }
                    
                        //compute for the flames number
                        $flamesNumber = $commonCharacterCount%6;
                    
                        //switch case to get corresponding status 
                        switch ($flamesNumber){
                            case 1:
                                $status = 'FRIENDS'; break;
                            case 2:
                                $status = 'LOVERS'; break;
                            case 3:
                                $status = 'ANGER'; break;
                            case 4:
                                $status = 'MARRIED'; break; 
                            case 5:
                                $status = 'ENGAGED'; break;
                            case 0:
                                $status = 'SOULMATES'; break; 
                        }

                        echo "<div class='results flames-title'>FLAMES Results:</div>";
                        echo "<div class='results'>". $lastName1 . ", " . $firstName1 . " and " . $lastName2 . ", " . $firstName2 . " are " . $status . "</div>";
                        
                        function zodiactonum($z){
                            $zodiacvalues = match ($z){
                            'Aries' => 1,
                            'Leo' => 2,
                            'Sagittarius' => 3,
                            'Taurus' => 4,
                            'Virgo' => 5,
                            'Capricornus' => 6,
                            'Gemini' => 7,
                            'Libra' => 8,
                            'Aquarius' => 9,
                            'Cancer' => 10,
                            'Scorpio' => 11,
                            'Pisces' => 12,
                            };
                            return $zodiacvalues;
                        }

                        // We then use the function to convert the zodiac signs
                        $z1 = zodiactonum($zodiacSign1);

                        $results = "";

                        // we use a table based on the chart to compare the zodiac's compatibility
                        // 1 - Great Match, 2 - Favorable, and 3 - Not Favorable
                        $sql = "SELECT * FROM zodiac_chart_array WHERE id = ?";

                        if($stmt = $pdo->prepare($sql)) {
                            if($stmt->execute([$z1])) {
                                // Fetch all rows of the table
                                $zodiac = $stmt->fetchAll();
                                
                                //iterate through all rows of the zodiac_chart_array table
                                foreach($zodiac as $zodiac) {

                                    $zodiacMatch = $zodiac[strtolower($zodiacSign2)];

                                    if ($zodiacMatch == 1){
                                        $results = "a Great Match";
                                    }
                                    
                                    else if($zodiacMatch == 2) {
                                        $results = "a Favorable Match";
                                    }
                        
                                    else if($zodiacMatch == 3) {
                                        $results = "an Unfavorable Match";
                                    }
                        
                                    else
                                        $results = "Unknown";
                                }
                            }
                        } else {
                            $_SESSION['message'] = "Inserted Successfully";
                        }
                        
                        echo "<div class='results zodiac-title'>Zodiac Compatibility Results:</div>";
                        echo "<div class='results'>" . $lastName1 . ", " . $firstName1 . "'s Zodiac is <em>" . $zodiacSign1 . "</em></div>";
                        echo "<div class='results'>" . $lastName2 . ", " . $firstName2 . "'s Zodiac is <em>" . $zodiacSign2 . "</em></div>";
                        echo "<div class='results'> Their Zodiac Compatibility is " . $results . "</div>";
                    
                    } // otherwise error message will show
                    else {
                        echo "Please select prospects to continue.";
                    }
                ?>
            </div>
        </section>
    </body>
</html>