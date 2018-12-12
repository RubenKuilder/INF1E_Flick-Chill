<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Example Database Connection</title>
    </head>
    <body>

        <form action="Example_Database_Connection_Prepared_Variable.php" method="post">
            <input type="text" name="keyword">
            <input type="submit" name="submit" value="Search">
        </form>
    <?php
    if(isset($_POST['submit']))
    {
        if(!empty($_POST['keyword']))
        {
            $keyword = "%" . $_POST['keyword'] . "%";

            // Step #1: Open a connection to MySQL...
            $conn = mysqli_connect("localhost", "root", "qwerty");

            // And test the connection
            if(!$conn)
            {
                DIE("Could not connect: " . mysqli_error($conn));
            }

            // Step #2: Selecting the database (assuming it has already been created)
            mysqli_select_db($conn, "music");

            // Step #3: Create the query
            $query = "SELECT Name, YearOfBirth FROM `artist` WHERE name LIKE ? ";

            // Step #4.1: Prepare query as a statement
            if($statement = mysqli_prepare($conn, $query))
            {
                // Step #4.2: Fill in the ? parameters!
                mysqli_stmt_bind_param($statement, 's', $keyword);

                //Step #5: Execute statement and check success
                if(mysqli_stmt_execute($statement)) {
                    echo "Query executed";
                }
                else {
                    echo "Error executing query";
                    die(mysqli_error($conn));
                }
                echo"<br><br>--------------<br><br>";
            }
            else{
                die(mysqli_error($conn));
            }

            // Step #6.1: Bind result to variables when fetching...
            mysqli_stmt_bind_result($statement, $name, $yob);
            // Step #6.2: And buffer the result if you want to display the data
            mysqli_stmt_store_result($statement);

            //Create heading
            echo "<h2>List of artists</h2>";

            // Step #7: Check if there are results in the statement
            if(mysqli_stmt_num_rows($statement) != 0)
            {
                echo "Number of rows: " . mysqli_stmt_num_rows($statement);
                // Make table
                echo "<table border='1'>";
                // Make table header
                echo "<th style='text-align: left;'>Name</th><th>Year of birth</th>";

                // Step #8: Fetch all rows of data from the result statement
                while (mysqli_stmt_fetch($statement)) {
                    // Create row
                    echo "<tr>";

                    // Create cells
                    echo "<td>" . $name . "</td>";
                    echo "<td>" . $yob . "</td>";

                    // Close row
                    echo "</tr>";
                }
                // Close table
                echo "</table>";
            }
            else{
                echo "No artists found";
            }

            // Step #9: Close the statement and free memory
            mysqli_stmt_close($statement);

            // Step #10: Close the connection!
            mysqli_close($conn);
        }
    }



    ?>
    </body>
</html>
