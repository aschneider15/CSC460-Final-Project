<?php
    $page_title = 'Create a New Forum';
    include('includes/header.html');
    require('../mysqli_connect.php');

    // Check for form submission:
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = []; // Initialize an error array.

        // Check for a forum name:
        if (empty($_POST['forum_name'])) {
            $errors[] = 'You forgot to enter a forum name.';
        } else {
            $fn = mysqli_real_escape_string($dbc, trim($_POST['forum_name']));
        }

        // Allow entry for the description (not required):
        $desc = mysqli_real_escape_string($dbc, trim($_POST['forum_desc']));

        if (empty($errors)) { // If everything's OK.

            // Make the query:
            $q = "INSERT INTO `forums`(`forum_name`, `creat_date`, `forum_desc`) VALUES ('$fn', NOW(), '$desc')";
            $r = @mysqli_query($dbc, $q); // Run the query.
            if ($r) { // If it ran OK.
    
                // Print a message:
                echo '<h1>Thank you!</h1>
            <p>Creation of new forum confirmed!</p>
            <a href="forum.php">Return to Forum Home</a>';
            } else { // If it did not run OK.
    
                // Public message:
                echo '<h1>System Error</h1>
                <p class="error">The forum could not be created due to a system error. We apologize for any inconvenience.</p>';
    
                // Debugging message:
                echo '<p>' . mysqli_error($dbc) . 'Query: ' . $q . '</p>';
            } // End of if ($r) IF.
    
            mysqli_close($dbc); // Close the database connection.
    
            // Include the footer and quit the script:
            include('includes/footer.html');
            exit();
        } else { // Report the errors.
    
            echo '<h1>Error!</h1>
            <p class="error">The following error(s) occurred:<br>';
            foreach ($errors as $msg) { // Print each error.
                echo " - $msg<br>\n";
            }
            echo '</p><p>Please try again.</p><p><br></p>';
        } // End of if (empty($errors)) IF.
    
        mysqli_close($dbc); // Close the database connection.
    }
?>

<h1>Create a New Forum</h1>
<form action="create_forum.php" method="post">
    <p>Forum Name: <input type="text" name="forum_name" size="45" maxlength="60" value="<?php if (isset($_POST['forum_name'])) echo $_POST['forum_name']; ?>"></p>
    <p>Forum Description: <input type="text" name="forum_desc" size="96" maxlength="128" value="<?php if (isset($_POST['forum_desc'])) echo $_POST['forum_desc']; ?>"></p>
    <p><input type="submit" name="submit" value="Create Forum"></p>
</form>

<?php include('includes/footer.html'); ?>