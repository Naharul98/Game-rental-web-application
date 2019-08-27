<?php
//returns an associative array of all games in the database
function find_all_games() 
{
    global $db;

    $sql = "SELECT * FROM Game;";
    $result = mysqli_query($db, $sql);
    return $result;
}
//returns an associative array of all Rules in the database
function get_all_rules() 
{
    global $db;

    $sql = "SELECT * FROM Rules;";
    $result = mysqli_query($db, $sql);
    return $result;
}
//returns an associative array of games in the database filtered according to
//platform, year and type provided as parameter
function filterGames($platformParameter,$yearParameter,$typeParameter) 
{
    global $db;
    $where = '1 = 1';
    if ($platformParameter != 'Any')
    {
        $par = db_escape($db,$platformParameter);
        $where .= " and Platform = '$par'";
    }
    if ($yearParameter != 'Any')
    {
        $par1 = db_escape($db,$yearParameter);
        $where .= " and Release_Year = '$par1'";
    }
    if ($typeParameter != 'Any')
    {
        $par2 = db_escape($db,$typeParameter);
        $where .= " and Game_Type = '$par2'";
    }
    $sql = "SELECT * FROM Game WHERE " . $where;
    $result = mysqli_query($db, $sql);
    return $result;
}

//returns an associative array of members in the database filtered according to
//id and name provided as parameter
function filterMembers($idParameter,$nameParameter) 
{
    global $db;
    $where = '1 = 1';
    if ($idParameter != '')
    {
        $par = db_escape($db,$idParameter);
        $where .= " and Member_ID = '$par'";
    }


    if ($nameParameter != '')
    {
        $par1 = db_escape($db,$nameParameter);
        $where .= " and Member_Name LIKE '%$par1%'";
    }

    $sql = "SELECT * FROM Member WHERE " . $where;
    $result = mysqli_query($db, $sql);
    return $result;
}

//returns an associative array of Staffs in the database filtered according to
//id and name provided as parameter
function filterAdmin($idParameter,$nameParameter) 
{
    global $db;
    $where = '1 = 1';
    if ($idParameter != '')
    {
        $par = db_escape($db,$idParameter);
        $where .= " and Staff_ID = '$par'";
    }


    if ($nameParameter != '')
    {
        $par1 = db_escape($db,$nameParameter);
        $where .= " and Staff_Name LIKE '%$par1%'";
    }

    $sql = "SELECT * FROM Staff WHERE " . $where;
    $result = mysqli_query($db, $sql);
    return $result;
}

//returns an associative array of  Rentals in the database filtered according to
//rentalID, MemberID and the game title associated with the rental, provided as parameter
function filterRentals($rID,$mID,$gameTitle)
{
    global $db;
    $where = '1 = 1';
    if ($rID != '')
    {
        $par = db_escape($db,$rID);
        $where .= " and Rental.Rental_ID='$par'";
    }


    if ($mID != '')
    {
        $par1 = db_escape($db,$mID);
        $where .= " and Member.Member_ID='$par1'";
    }

    if ($gameTitle != 'Any')
    {
        $par2 = db_escape($db,$gameTitle);
        $where .= " and Game.Title LIKE '$par2'";
    }
    $sql = "SELECT Rental.Rental_ID, Game.Title,Member.Member_ID, Member.Member_Name, Rental.Start_Date, Rental.Return_Date, Rental.Extended_Until, Rental.Date_Returned,(Rental.Fee-Rental.Paid) as Outstanding_Fee FROM Member RIGHT JOIN Rental ON Member.Member_ID=Rental.Member_ID LEFT JOIN Game ON Rental.Game_ID=Game.Game_ID WHERE " . $where;
    $result = mysqli_query($db, $sql);
    return $result;
}

//returns query of rentals where the members still have amount outstanding to pay
function getCurrentOverdueRentals()
{
    global $db;
    $sql = "SELECT Rental.Rental_ID, Game.Title,Member.Member_ID, Member.Member_Name, Rental.Start_Date, Rental.Return_Date, Rental.Extended_Until, Rental.Date_Returned,(Rental.Fee-Rental.Paid) as Outstanding_Fee FROM Member RIGHT JOIN Rental ON Member.Member_ID=Rental.Member_ID LEFT JOIN Game ON Rental.Game_ID=Game.Game_ID WHERE (Rental.Extended_Until IS NULL AND Rental.Return_Date<NOW() AND Rental.Date_Returned IS NULL) OR (Rental.Extended_Until IS NOT NULL AND Rental.Extended_Until<NOW() AND Rental.Date_Returned IS NULL)";
    $result = mysqli_query($db, $sql);
    return $result;
}

//returns an associative array of a member tuple according to its ID provided as parameter
function find_member_by_id($id) 
{
    global $db;

    $sql = "SELECT * FROM Member ";
    $sql .= "WHERE Member_ID=" . db_escape($db,$id);
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

//returns an associative array of member tuples who are Banned at current date and time
function getBannedMembers() 
{
    global $db;

    $sql = "SELECT * FROM Member ";
    $sql .= "WHERE Banned_Until IS NOT NULL AND Banned_Until>NOW();";
    $result = mysqli_query($db, $sql);
    return $result; // returns an assoc. array
}

//returns an associative array of a Staff/Admin tuple according to its Username provided as parameter
function find_admin_by_username($name) 
{
    global $db;

    $sql = "SELECT * FROM Staff ";
    $sql .= "WHERE Username='" . db_escape($db,$name) . "'";
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

//returns an associative array of a Staff/Admin tuple according to its ID provided as parameter
function find_admin_by_id($id)
{
    global $db;

    $sql = "SELECT * FROM Staff ";
    $sql .= "WHERE Staff_ID=" . db_escape($db,$id);
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

//returns an associative array of a rule tuple according to its ID provided as parameter
function find_rule_by_id($id) 
{
    global $db;

    $sql = "SELECT * FROM Rules ";
    $sql .= "WHERE Rule_ID=" . db_escape($db,$id);
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

//returns an associative array of a rental tuple according to its ID provided as parameter
function find_rental_by_id($id) {
    global $db;

    $sql = "SELECT * FROM Rental ";
    $sql .= "WHERE Rental_ID=" . db_escape($db,$id);
    $result = mysqli_query($db, $sql);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

//returns an associative array of a game tuple according to its ID provided as parameter
function find_game_by_id($identification) 
{
    global $db;

    $sql = 'SELECT * FROM Game WHERE Game_ID=' . db_escape($db,$identification);
    $result = mysqli_query($db, $sql);
    return $result;
}

//Deletes member from the table in the database according to its ID provided as parameter
//returns true if delete was successful
function delete_member($id) 
{
    global $db;

    $sql = "DELETE FROM Member ";
    $sql .= "WHERE Member_ID='" . db_escape($db,$id) . "' ";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) 
    {
        return true;
    } else 
    {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//Deletes a Staff/Admin from the table in the database according to its ID provided as parameter
//returns true if delete was successful
function delete_admin($id)
{
    global $db;

    $sql = "DELETE FROM Staff ";
    $sql .= "WHERE Staff_ID='" . db_escape($db,$id) . "' ";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//Deletes a Rental from the table in the database according to its ID provided as parameter
//returns true if delete was successful
function delete_rental($id) 
{
    global $db;

    $sql = "DELETE FROM Rental ";
    $sql .= "WHERE Rental_ID='" . db_escape($db,$id) . "' ";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//Deletes a Rule from the table in the database according to its ID provided as parameter
//returns true if delete was successful
function delete_rule($id) 
{
    global $db;

    $sql = "DELETE FROM Rules ";
    $sql .= "WHERE Rule_ID='" . db_escape($db,$id) . "' ";
    $result = mysqli_query($db, $sql);

    // For DELETE statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // DELETE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//Inserts a new Member in the database according to the tuple provided as associative array in the parameter
//returns true if Insert was successful
function insert_member($subject) 
{
    global $db;
    $errors = validate_member($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   
    $sql = "INSERT INTO Member ";
    $sql .= "(Member_Name, Member_Email, Member_Contact) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$subject['Member_Name']) . "',";
    $sql .= "'" . db_escape($db,$subject['Member_Email']) . "',";
    $sql .= "'" . db_escape($db,$subject['Member_Contact']) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else
    {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}


//Inserts a new Admin/Staff in the database according to the tuple provided as associative array in the parameter
//returns true if Insert was successful
//if errors exist, then it returns an array containing error messages
function insert_admin($subject) 
{
    global $db;
    $errors = validate_admin($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   

    $real_hashed_password = password_hash($subject['Hashed_Password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO Staff ";
    $sql .= "(Staff_Name, Username, Hashed_Password,Privilege) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$subject['Staff_Name']) . "',";
    $sql .= "'" . db_escape($db,$subject['Username']) . "',";
    $sql .= "'" . $real_hashed_password . "',";
    $sql .= "'" . $subject['Privilege'] . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) 
    {
        return true;
        
    } 
    else 
    {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

//takes a tuple of a admin as an associative array as parameter
//checks data in the tupple to make sure they align with database rules
//returns an array of error messages according errors that may exist in the tuple
function validate_admin($subject)
{
    $errors = [];
    if(has_length_greater_than($subject['Username'],5) == false)
    {
        $errors[] = "User name must be more than 5 characters";
    }
    if(has_length_greater_than($subject['Hashed_Password'],8) == false)
    {
        $errors[] = "Password must be more than 8 characters";
    }
    if($subject['Privilege'] == '0')
    {
        $errors[] = "Please Select privilege for the staff from the drop down";
    }
    if(is_blank($subject['Staff_Name']))
    {
        $errors[] = "Please input a name for the staff";
    }
    if (!has_unique_username($subject['Username'], $subject['Staff_ID'] ?? 0))
    {
        $errors[] = "This username is already taken";
    }
    return $errors;
}

//Inserts a new Rental in the database according to the tuple provided as associative array in the parameter
//returns true if Insert was successful
//if errors exist, then it returns an array containing error messages
function insert_rental($subject)
{
    global $db;
    $errors = validate_rental_new($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   
    $sql = "INSERT INTO Rental ";
    $sql .= "(Game_ID, Member_ID,Start_Date,Return_Date,Fee,Paid) ";
    $sql .= "VALUES (";
    $sql .= "" . db_escape($db,$subject['Game_ID']) . ",";
    $sql .= "" . db_escape($db,$subject['Member_ID']) . ",";
    $sql .= "'" . $subject['Start_Date'] . "',";
    $sql .= "'" . $subject['Return_Date'] . "',";
    $sql .= "" . $subject['Fee'] . ",";
    $sql .= "" . $subject['Paid'] . "";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $result is true/false
    if($result) 
    {
        return true;

    } 
    else 
    {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a tuple of a rental as an associative array as parameter
//checks data in the tuple to make sure they align with database rules
//returns an array of error messages according errors that may exist in the tuple
function validate_rental_new($subject)
{
    $errors = [];

    if($subject['Game_ID'] <=0) 
    {
        $errors[] = "Please Select a game from the dropdown";
    }
    if(is_blank($subject['Member_ID'])) 
    {
        $errors[] = "Please Select a member from the select member page.";
    }
    if(is_blank($subject['Start_Date'])) 
    {
        $errors[] = "Rental needs to have a start date.";
    }
    if(is_blank($subject['Return_Date'])) 
    {
        $errors[] = "Rental needs to have a return date.";
    }
    if(has_valid_date_format($subject['Return_Date']) == false) 
    {
        $errors[] = "Please select a valid date from the date time picker for return date";
    }
    else
    {
        $ret = strtotime($subject['Return_Date']);
        $today = date("Y-m-d");
        if($today>$ret)
        {
            $errors[] = "return date cannot be of later date than current date";
        }
    }
    if(has_valid_date_format($subject['Start_Date']) == false) 
    {
        $errors[] = "Please select a valid date from the date time picker for start date";
    }
    else
    {
        $start = strtotime($subject['Start_Date']);
        $today = date("Y-m-d");
        if($today>$start)
        {
            $errors[] = "start date cannot be of later date than current date";
        }
    }
    if(has_valid_date_format($subject['Start_Date']) == true && has_valid_date_format($subject['Return_Date']) == true) 
    {
        $start = strtotime($subject['Start_Date']);
        $ret = strtotime($subject['Return_Date']);
        if($ret<$start)
        {
            $errors[] = "start date cannot be of later date than return date";
        }

    }
    if(is_blank($subject['Fee'])) 
    {
        $errors[] = "Rental needs to have a fee";
    }
    if(ctype_digit($subject['Fee']) == false)
    {
        $errors[] = "Fee must not contain symbols or letters";
    }
    if(ctype_digit($subject['Paid']) == false)
    {
        $errors[] = "The amout paid field must not contain symbols or letters";
    }

    if(is_blank($subject['Paid'])) 
    {
        $errors[] = "Please fill out the Paid row";
    }
    return $errors;
}

//Inserts a new Rule in the database according to the tuple provided as associative array in the parameter
//returns true if Insert was successful
//if errors exist, then it returns an array containing error messages
function insert_rule($rule) 
{
    global $db;
    $errors = validate_rule($rule);
    if(!empty($errors))
    {   
        return $errors;
    }  
    $sql = "INSERT INTO Rules ";
    $sql .= "(Rule) ";
    $sql .= "VALUES (";
    $sql .= "'" . db_escape($db,$rule["Rule"]) . "'";
    $sql .= ")";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // INSERT failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a parameter of memberID
//returns an associative array containing count for the Number of current rentals that
//the member in the parameter currently has which he has not returned 
//used to validate if a member is eligible for rental
function getNumberOfCurrentRental($id) 
{
    global $db;

    $sql = "SELECT COUNT(*) as numberOfCurrentRentals FROM(
SELECT Rental.Rental_ID
FROM Rental LEFT JOIN Member On Rental.Member_ID=Member.Member_ID
WHERE (Rental.Return_Date>NOW() OR Rental.Extended_Until>NOW()) AND (Rental.Date_Returned IS NULL) AND (Member.Member_ID=" . db_escape($db,$id) . ")) as k";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return $result;
    } 
    else 
    {
        //  failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a parameter of memberID
//returns an associative array containing count for the Number of current extensions that a member has done
//which he has not returned yet
//used to validate if a member is eligible for extensions
function getNumberOfCurrentExtensions($id) 
{
    global $db;

    $sql = "SELECT COUNT(*) as numberOfCurrentExtensions FROM(
SELECT Rental.Rental_ID
FROM Rental LEFT JOIN Member On Rental.Member_ID=Member.Member_ID
WHERE (Rental.Extended_Until>NOW()) AND (Rental.Date_Returned IS NULL) AND  (Member.Member_ID=" . db_escape($db,$id) . ")) as j";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return $result;
    } 
    else 
    {
        //  failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a parameter of memberID
//returns an associative array containing count for the Number of pending returnes that a member currently has in his tally
//used to validate if a member is eligible for rental
function getNumberOfPendingReturnForGame($id)
{
    global $db;

    $sql = "SELECT COUNT(*) as numberOfPendingReturns FROM
            (SELECT Game.Title FROM Game RIGHT Join Rental on Game.Game_ID=Rental.Game_ID
            WHERE Rental.Date_Returned IS NULL AND Game.Game_ID= " . db_escape($db,$id) . ") as h";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return $result;
    } 
    else 
    {
        //  failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a parameter of memberID
//returns an associative array containing count for the Number of failed returns that the member has within the past 12 months
//used to validate if a member is eligible for rental
function getNumberOfFailedReturnsWithinLast12Months($id) 
{
    global $db;

    $sql = "SELECT COUNT(*) as numberOfFailedReturns FROM(
SELECT Rental.Rental_ID
FROM Rental LEFT JOIN Member On Rental.Member_ID=Member.Member_ID
WHERE (Rental.Date_Returned>Rental.Return_Date OR (NOW()>Rental.Return_Date AND Rental.Date_Returned IS NULL)) AND (NOW()>DATE_ADD(Rental.Return_Date, INTERVAL -1 YEAR)) AND (Rental.Member_ID=" . db_escape($db,$id) . ")) as m";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return $result;
    } 
    else
    {
        //  failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//takes a parameter of memberID
//returns an associative array containing count for the Number of games that the member has returned which had bad condition
//and the extra charge has not been settled
//used to validate if a member is eligible for rental
function getNumberOfDamagedGameWhichHasNotBeenSettled($id) 
{
    global $db;

    $sql = "SELECT COUNT(*) as numberOfDamagedGameWhichHasNotBeenSettled FROM(
SELECT Rental.Rental_ID
FROM Rental LEFT JOIN Member On Rental.Member_ID=Member.Member_ID
WHERE (Rental.Return_Condition LIKE 'Unsatisfactory') AND ((Rental.Fee-Rental.Paid) >0) AND (Rental.Member_ID=" . db_escape($db,$id) . ")) as c";
    $result = mysqli_query($db, $sql);
    // For INSERT statements, $rule is true/false
    if($result) 
    {
        return $result;
    } 
    else 
    {
        //  failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}

//returns and associative array of members who has pending fees
function getOutstandingFeesMembers()
{
    global $db;
    $sql = "SELECT Rental.Rental_ID, Game.Title,Member.Member_ID, Member.Member_Name,Member.Member_Email,Member.Member_Contact, Rental.Start_Date, Rental.Return_Date, Rental.Extended_Until, Rental.Date_Returned,(Rental.Fee-Rental.Paid) as Outstanding_Fee FROM Member RIGHT JOIN Rental ON Member.Member_ID=Rental.Member_ID LEFT JOIN Game ON Rental.Game_ID=Game.Game_ID WHERE (Rental.Fee-Rental.Paid)>0";
    $result = mysqli_query($db, $sql);
    return $result;
}

//takes an associative array representing tuple for the member to update in the database,
//returns an array of error messages if the data in tuple doesnt conform to the database restrictions
//returns true if the act of updating was successful
function update_member($subject) 
{
    global $db;
    $errors = validate_member($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   
    $sql = "UPDATE Member SET ";
    $sql .= "Member_Name='" . db_escape($db,$subject['Member_Name']) . "', ";
    $sql .= "Member_Email='" . db_escape($db,$subject['Member_Email']) . "', ";
    $sql .= "Member_Contact='" . db_escape($db,$subject['Member_Contact']) . "', ";

    if($subject['Banned_Until'] == "")
    {

        $sql .= "Banned_Until=NULL ";
    }
    else
    {
        $sql .= "Banned_Until='" . $subject['Banned_Until'] . "' ";
    }
    $sql .= "WHERE Member_ID=" . db_escape($db,$subject['Member_ID']);

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) 
    {
        return true;
                
    } 
    else 
    {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

//takes an associative array representing tuple for the Admin/Staff to update in the database,
//returns an array of error messages if the data in tuple doesnt conform to the database restrictions
//returns true if the act of updating was successful
function update_admin($subject)
{
    global $db;
    $errors = validate_admin($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   
    $sql = "UPDATE Staff SET ";
    $sql .= "Staff_Name='" . db_escape($db,$subject['Staff_Name']) . "', ";
    $sql .= "Privilege='" . $subject['Privilege'] . "' ";

    $sql .= "WHERE Staff_ID=" . db_escape($db,$subject['Staff_ID']);

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

//takes an associative array representing tuple for the rental to update in the database,
//returns an array of error messages if the data in tuple doesnt conform to the database restrictions
//returns true if the act of updating was successful
function update_rental($subject) 
{
    global $db;
    $errors = validate_rental_update($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   

    $sql = "UPDATE Rental SET ";
    $sql .= "Member_ID='" . db_escape($db,$subject['Member_ID']) . "', ";
    $sql .= "Game_ID='" . db_escape($db,$subject['Game_ID']) . "', ";
    $sql .= "Start_Date='" . db_escape($db,$subject['Start_Date']) . "', ";
    $sql .= "Return_Date='" . db_escape($db,$subject['Return_Date']) . "', ";
    $sql .= "Return_Condition='" . db_escape($db,$subject['Return_Condition']) . "', ";
    $sql .= "Fee='" . $subject['Fee'] . "', ";
    $sql .= "Paid='" . $subject['Paid'] . "', ";
    if($subject['Extended_Until'] == "")
    {

        $sql .= "Extended_Until=NULL, ";
    }
    else
    {
        $sql .= "Extended_Until='" . $subject['Extended_Until'] . "', ";
    }
    if($subject['Date_Returned'] == "")
    {

        $sql .= "Date_Returned=NULL ";
    }
    else
    {
        $sql .= "Date_Returned='" . $subject['Date_Returned'] . "' ";
    }
    $sql .= "WHERE Rental_ID=" . db_escape($db,$subject['Rental_ID']);

    $result = mysqli_query($db, $sql);

    // For UPDATE statements, $result is true/false
    if($result) 
    {
        return true;
    } 
    else 
    {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }

}

//takes a tuple of a rental as an associative array as parameter
//checks data in the tuple to make sure they align with database rules
//returns an array of error messages according errors that may exist in the tuple
function validate_rental_update($subject)
{
    $errors = [];



    if($subject['Game_ID'] =="") 
    {
        $errors[] = "There was an error";
    }
    if($subject['Member_ID'] =="0") 
    {
        $errors[] = "There was an error";
    }

    if(is_blank($subject['Start_Date'])) 
    {
        $errors[] = "Rental needs to have a start date.";
    }
    if(is_blank($subject['Return_Date'])) 
    {
        $errors[] = "Rental needs to have a return date.";
    }

    if(is_blank($subject['Extended_Until']) == false) 
    {
        if(has_valid_date_format($subject['Extended_Until']) == false) 
        {
            $errors[] = "Please select a valid date from the date time picker for Extended Until";
        }
        else
        {
            $ret = strtotime($subject['Return_Date']);
            $start = strtotime($subject['Start_Date']);
            $extended = strtotime($subject['Extended_Until']);
            $today = date("Y-m-d");
            if($extended<$start)
            {
                $errors[] = "Extension date cannot be of less than Rent Start date";
            }
            if($extended<$ret)
            {
                $errors[] = "Extension date cannot be less than  rental return date";
            }
            if($extended<$today)
            {
                $errors[] = "Extension date cannot be less than today date";
            }

        }
    }

    if(is_blank($subject['Date_Returned']) == false) 
    {
        if($subject['Return_Condition'] == "Pending")
        {
            $errors[] = "If a game is returned then the return condition must not be pending";
        }
        if(has_valid_date_format($subject['Date_Returned']) == false) 
        {
            $errors[] = "Please select a valid date from the date time picker for Date Returned";
        }
        else
        {
            $start = strtotime($subject['Start_Date']);
            $dateReturned = strtotime($subject['Date_Returned']);
            if($dateReturned<$start)
            {
                $errors[] = "Date returned for game cannot be of less than Rent Start date";
            }
        }
    }
    if($subject['Return_Condition'] != "Pending" && is_blank($subject['Date_Returned']))
    {
        $errors[] = "The return date for the item is not specified despite the return condition being not pending";
    }

    if(has_valid_date_format($subject['Return_Date']) == false) 
    {
        $errors[] = "Please select a valid date from the date time picker for return date";
    }
    else
    {
        $ret = strtotime($subject['Return_Date']);
        $today = date("Y-m-d");
        if($today>$ret)
        {
            $errors[] = "return date cannot be of later date than current date";
        }
    }
    if(has_valid_date_format($subject['Return_Date']) == false) 
    {
        $errors[] = "Please select a valid date from the date time picker for return date";
    }
    if(has_valid_date_format($subject['Start_Date']) == false) 
    {
        $errors[] = "Please select a valid date from the date time picker for start date";
    }
    else
    {
        $start = strtotime($subject['Start_Date']);
        $today = date("Y-m-d");
        if($today>$start)
        {
            $errors[] = "start date cannot be of later date than current date";
        }
    }
    if(has_valid_date_format($subject['Start_Date']) == true && has_valid_date_format($subject['Return_Date']) == true) 
    {
        $start = strtotime($subject['Start_Date']);
        $ret = strtotime($subject['Return_Date']);
        if($ret<$start)
        {
            $errors[] = "start date cannot be of later date than return date";
        }

    }
    if(is_blank($subject['Fee'])) 
    {
        $errors[] = "Rental needs to have a fee";
    }
    if(ctype_digit($subject['Fee']) == false)
    {
        $errors[] = "Fee must not contain symbols or letters";
    }
    if(ctype_digit($subject['Paid']) == false)
    {
        $errors[] = "The amout paid field must not contain symbols or letters";
    }
    if(is_blank($subject['Paid'])) 
    {
        $errors[] = "Please fill out the Paid row";
    }

    return $errors;
}

//takes a tuple of a Member as an associative array as parameter
//checks data in the tuple to make sure they align with database rules
//returns an array of error messages according errors that may exist in the tuple
function validate_member($subject) 
{
    $errors = [];

    if(is_blank($subject['Member_Name'])) 
    {
        $errors[] = "Name cannot be blank.";
    }
    if(is_blank($subject['Member_Email'])) 
    {
        $errors[] = "Email cannot be blank.";
    }
    if(is_blank($subject['Member_Contact'])) 
    {
        $errors[] = "Contact Details cannot be blank.";
    }
    if(!has_length($subject['Member_Name'], ['min' => 2, 'max' => 100]))
    {
        $errors[] = "Name must be between 2 and 100 characters.";
    }
    if(!has_length($subject['Member_Email'], ['min' => 2, 'max' => 100]))
    {
        $errors[] = "Email must be between 2 and 100 characters.";
    }
    if(!has_length($subject['Member_Contact'], ['min' => 2, 'max' => 12]))
    {
        $errors[] = "Contact must be between 2 and 11 characters.";
    }
    if(has_valid_email_format($subject['Member_Email']) == false)
    {
        $errors[] = "Email must be of a valid format";
    }
    //checks if the contact number is all digits or not
    if(ctype_digit($subject['Member_Contact']) == false)
    {
        $errors[] = "Contact number must not contain symbols or letters";
    }
    return $errors;
}

//takes a tuple of a Rule as an associative array as parameter
//checks data in the tuple to make sure they align with database rules
//returns an array of error messages according errors that may exist in the tuple
function validate_rule($subject) 
{
    $errors = [];
    if(is_blank($subject['Rule'])) 
    {
        $errors[] = "Rule cannot be blank.";
    }

    if(!has_length($subject['Rule'], ['min' => 6, 'max' => 65533]))
    {
        $errors[] = "Rule must be between 5 and 65530 characters.";
    }

    return $errors;
}

//takes an associative array representing tuple for the Rule to update in the database,
//returns an array of error messages if the data in tuple doesnt conform to the database restrictions
//returns true if the act of updating was successful
function update_rules($subject) 
{
    global $db;
    $errors = validate_rule($subject);
    if(!empty($errors))
    {   
        return $errors;
    }   
    $sql = "UPDATE Rules SET ";
    $sql .= "Rule='" . db_escape($db,$subject['Rule']) . "' ";
    $sql .= "WHERE Rule_ID=" . db_escape($db,$subject['Rule_ID']);

    $result = mysqli_query($db, $sql);
    // For UPDATE statements, $result is true/false
    if($result) 
    {
        return true;
        
    } 
    else 
    {
        // UPDATE failed
        echo mysqli_error($db);
        db_disconnect($db);
        exit;
    }
}



?>
