<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><?php $zk = $_POST['searchbar']; echo 'zoeken naar' . $zk;  ?></title>
    </head>
    <body>
        <?php
            // Step #1: Open a connection to MySQL...
            $conn = mysqli_connect("localhost", "root", "");

            // And test the connection
            if(!$conn)
            {
                DIE("Could not connect: " . mysqli_error($conn));
            }

            // Step #2: Selecting the database (assuming it has already been created)
            mysqli_select_db($conn, "flicknchill");
            $search = $_POST['searchbar'];
			// Step #3: Create the query
			$query = "SELECT * FROM video where Description like '%$search%'";

            // Step #4: Prepare query as a statement
            if($statement = mysqli_prepare($conn, $query))
            {
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
            mysqli_stmt_bind_result($statement, $title, $url);
            // Step #6.2: And buffer the result if you want to display the data
            mysqli_stmt_store_result($statement);

            //Create heading
            echo "<h2>Search results</h2>";

            // Step #7: Check if there are results in the statement
            if(mysqli_stmt_num_rows($statement) != 0)
            {
                echo mysqli_stmt_num_rows($statement) . ": results in 0.001 seconds";
                // Make table
                echo "<table border='1'>";
                // Make table header
                echo "<th style='text-align: left;'>title</th><th>video</th>";

                // Step #8: Fetch all rows of data from the result statement
                while (mysqli_stmt_fetch($statement)) {
                    // Create row
                    echo "<tr>";

                    // Create cells
                    echo "<td>" . $title . "</td>";
                    echo "<td>" .  $url . "</td>";

                    // Close row
                    echo "</tr>";
                }
                // Close table
                echo "</table>";
            }
            else{
                echo "No results found";
            }

            // Step #9: Close the statement and free memory
            mysqli_stmt_close($statement);

            // Step #10: Close the connection!
            mysqli_close($conn);
        ?>
    </body>
</html>
