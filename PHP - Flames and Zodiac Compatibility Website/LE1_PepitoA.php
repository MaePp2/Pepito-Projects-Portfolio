<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Compatibility Form</title>

        <!-- fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,500&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
                
        <!-- stylesheet -->
        <link rel="stylesheet" href="style.css" />
    </head>
    <body>
        <header class="header">
            <div class="left-section">
                <div class="logo">Compatibility Test</div>
            </div>
            <div class="right-section">
                <div class="section-le">IT135-8L LE#1</div>
            </div>
        </header>
        <main>
            <section class="form-grid">
                <form class="answer-form" action="LE1_PepitoA.php" method="POST">
                    <div class="persons-forms">
                        <div class="your-info">
                            <div class="form-title">Your Name</div>
                            <div class="first-question">
                                <label for="your-fname">First name:</label>
                                <input type="text" id="your-fname" name="your-fname" value="<?php echo $_POST['your-fname']??''; ?>">
                            </div>
                            <div>
                                <label for="your-lname">Last name:</label>
                                <input type="text" id="your-lname" name="your-lname" value="<?php echo $_POST['your-lname']??''; ?>">
                            </div>
                            <div>
                                <label for="your-bday">Birthday:</label>
                                <input type="date" id="your-bday" name="your-bday" value="<?php echo $_POST['your-bday']??''; ?>">
                            </div>
                        </div>
                        <div class="crush-info">
                            <div class="form-title">Your Crush</div>
                            <div class="first-question">
                                <label for="crush-fname">First name:</label>
                                <input type="text" id="crush-fname" name="crush-fname" value="<?php echo $_POST['crush-fname']??''; ?>">
                            </div>
                            <div>
                                <label for="crush-lname">Last name:</label>
                                <input type="text" id="crush-lname" name="crush-lname" value="<?php echo $_POST['crush-lname']??''; ?>">
                            </div>
                            <div>
                                <label for="crush-bday">Birthday:</label>
                                <input type="date" id="crush-bday" name="crush-bday" value="<?php echo $_POST['crush-bday']??''; ?>">
                            </div>
                            </div>
                    </div>
                    <button class="submit-button" name="submit-button">Submit</button>
                </form>
                <div class="compatibility-results">
                    <div class="form-title">Results</div>
                    <?php 
                        class Person {
                            // Person Attributes
                            protected string $first_name;
                            protected string $last_name;
                            protected string $birthday;
                            protected Zodiac $zodiac;

                            // Person Constructor that takes in first
                            public function __construct($first_name, $last_name, $birthday) {
                                $this-> first_name = $first_name;
                                $this-> last_name = $last_name;
                                $this-> birthday = $birthday;
                                $this-> zodiac = new Zodiac($birthday);
                            }
                            
                            // Methods
                            // GetFullName() - returns the full name in the format "last name, first name"
                            public function GetFullName() {
                                return $this->last_name . ", " . $this->first_name;
                            }

                            // Getter functions are needed since attributes are protected
                            // getFirstName() - returns the first name
                            function getFirstName() {
                                return $this->first_name;
                            }

                            // getLastName() - returns the last name
                            function getLastName() {
                                return $this->last_name;
                            }
                        }

                        class Zodiac{
                            //Zodiac attributes
                            private $zodiacSign;
                            private $symbol;
                            private $startDate;
                            private $endDate;
                        
                            //Zodiac constructor that takes in one parameter and assigns the zodiac sign, symbol, start date, end date based on the person's birthday
                            function __construct($birthday){
                                // Open file pointer (for Zodiac.txt) - https://www.php.net/manual/en/function.fopen.php
                                // or die is a catch-all error message
                                $zodiac_file = fopen("Zodiac.txt", "r") or die("Unable to open file!");

                                // Read until end of file - https://www.php.net/manual/en/function.feof.php
                                // Read line from pointer - https://www.php.net/manual/en/function.fgets.php
                                while(!feof($zodiac_file)) {
                                    $zodiac_array[] = fgets($zodiac_file);
                                }
                                // fclose - https://www.php.net/manual/en/function.fclose.php
                                // free up memory
                                fclose($zodiac_file);

                                foreach($zodiac_array as $zodiac) {
                                    $zodiac = explode("; ", $zodiac);
                                    $zodiac_sign = $zodiac[0];
                                    $zodiac_symbol = $zodiac[1];
                                    $zodiac_start_date = $zodiac[2];
                                    $zodiac_end_date = $zodiac[3];

                                    // Check if the date is within the start and end date
                                    if(
                                        date("m", strtotime($birthday)) == date("m", strtotime($zodiac_start_date)) &&
                                        date("d", strtotime($birthday)) >= date("d", strtotime($zodiac_start_date))
                                        ||
                                        date("m", strtotime($birthday)) == date("m", strtotime($zodiac_end_date)) &&
                                        date("d", strtotime($birthday)) <= date("d", strtotime($zodiac_end_date))
                                    ) {

                                        $this->zodiacSign = $zodiac_sign;
                                        $this->symbol = $zodiac_symbol;
                                        $this->startDate = $zodiac_start_date;
                                        $this->endDate = $zodiac_end_date;
                                    }
                                }
                            }

                            // Methods
                            // ComputeZodiacCompatibility() - takes two zodiac signs as input and outputs compatibility based on this chart below. Use multidimensional arrays.
                            public function ComputeZodiacCompatibility($zodiac1, $zodiac2) {
                                // We make two variables getting the person's zodiac sign
                                $zodiacSign1 = $zodiac1->zodiacSign;
                                $zodiacSign2 = $zodiac2->zodiacSign;
                                
                                // We make a function to convert the zodiac sign into a number
                                function zodiactonum($z){
                                    $zodiacvalues = match ($z){
                                    'Aries' => 0,
                                    'Leo' => 1,
                                    'Sagittarius' => 2,
                                    'Taurus' => 3,
                                    'Virgo' => 4,
                                    'Capricornus' => 5,
                                    'Gemini' => 6,
                                    'Libra' => 7,
                                    'Aquarius' => 8,
                                    'Cancer' => 9,
                                    'Scorpio' => 10,
                                    'Pisces' => 11,
                                    };
                                return $zodiacvalues;
                                }

                                // We then use the function to convert the zodiac signs
                                $z1 = zodiactonum($zodiacSign1);
			                    $z2 = zodiactonum($zodiacSign2);

                                // we make a multidimensional array based on the chart to compare the zodiac's compatibility
                                // 1 - Great Match, 2 - Favorable, and 3 - Not Favorable
                                $zodiaccompute = array(
                                    array(1, 1, 1, 3, 3, 3, 1, 1, 1, 3, 3, 2),
                                    array(1, 1, 1, 3, 3, 3, 1, 1, 1, 2, 2, 2),
                                    array(1, 1, 1, 3, 3, 3, 1, 1, 1, 2, 2, 2),
                                    array(3, 2, 3, 1, 1, 1, 3, 2, 3, 1, 1 ,1),
                                    array(3, 2, 3, 1, 1, 1, 3, 3, 2, 1, 1, 2),
                                    array(3, 2, 3, 1, 1, 1, 3, 2, 3, 1, 1 ,1),
                                    array(1, 1, 2, 3, 2, 2, 1, 1, 1, 3, 3, 3),
                                    array(2, 1, 1, 2, 3, 3, 1, 1, 1, 3, 3, 2),
                                    array(1, 1, 1, 3, 3, 3, 1, 1, 1, 3, 2, 2),
                                    array(3, 2, 2, 1, 1, 1, 3, 3, 3, 1, 1, 1),
                                    array(2, 2, 3, 1, 1, 1, 3, 3, 3, 1, 1, 1),
                                    array(2, 2, 2, 1, 2, 1, 3, 3, 3, 1, 1, 1),
                                    );
                        
                                    if ($zodiaccompute[$z1][$z2] == 1){
                                        $results = "GREAT";
                                    }
                                    
                                    else if($zodiaccompute[$z1][$z2] == 2){
                                        $results = "FAVORABLE";
                                    }
                        
                                    else if($zodiaccompute[$z1][$z2] == 3){
                                        $results = "UNFAVORABLE";
                                    }
                        
                                    else
                                        $results = "Unknown";
                                    
                                    return $results;
                            }
                        }
                    ?>
                    <div class="results-names">
                        <?php
                            // when user clicks on the submit button
                            if(isset($_POST['submit-button']))
                            {
                                $person1 = new Person($_POST["your-fname"], $_POST["your-lname"], $_POST["your-bday"]);
                                $person2 = new Person($_POST["crush-fname"], $_POST["crush-lname"], $_POST["crush-bday"]);

                                echo $person1->GetFullName() . " <br>and<br> " . $person2->GetFullName();
                            }
                            // otherwise error message will show
                            else
                            {
                                echo "Please input in the required forms to continue.";
                            }
                        ?>
                    </div>
                    <div class="results-flames">
                        <?php
                            // when user clicks on the submit button
                            if(isset($_POST['submit-button']))
                            {
                                //store person first name and last name attributes 
                                $firstname1 = $person1->getFirstName();
                                $lastname1 = $person1->getLastName();
                                $firstname2 = $person2->getFirstName();
                                $lastname2 = $person2->getLastName();
                            
                                //concatenate names, remove non-alphanumeric characters from the string, and store converted lowercase fullnames for correct comparison of common letters
                                $person1FullName = strtolower(preg_replace('/[^a-zA-Z0-9]/','', $firstname1. $lastname1));
                                $person2FullName = strtolower(preg_replace('/[^a-zA-Z0-9]/','', $firstname2. $lastname2));
                            
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

                                echo "<div class='results-flames-title'>FLAMES:</div>";
                                echo "<div class='results-flames-answer'>" . $status . "</div>";
                            }
                            // otherwise error message will show
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                    <div class="results-zodiac">
                        <?php
                            // when user clicks on the submit button
                            if(isset($_POST['submit-button']))
                            {
                                $zodiac1 = new Zodiac($_POST["your-bday"]);
                                $zodiac2 = new Zodiac($_POST["crush-bday"]);
                                 
                                echo "<div class='results-zodiac-title'>Zodiac Compatibility:</div>";
                                echo "<div class='results-zodiac-answer'>" . $zodiac1->ComputeZodiacCompatibility($zodiac1, $zodiac2) . "</div>";
                            }
                            // otherwise error message will show
                            else
                            {
                                echo "";
                            }
                        ?>
                    </div>
                </div>
            </section>
        </main>
    </body>
</html>