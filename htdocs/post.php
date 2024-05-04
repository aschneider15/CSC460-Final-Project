<?php
// This page handles the message post.
// It also displays the form if creating a new thread.
include('includes/header.html');
require('../mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.

    // Validate thread ID ($thread_id), which may not be present:
	if (isset($_POST['thread_id']) && filter_var($_POST['thread_id'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
		$thread_id = $_POST['thread_id'];
	} else {
		$thread_id = FALSE;
	}

	// If there's no thread ID, a subject must be provided:
	if (!$thread_id && empty($_POST['subject'])) {
		$subject = FALSE;
		echo '<p class="bg-danger">Please enter a subject for this post.</p>';
	} elseif (!$thread_id && !empty($_POST['subject'])) {
		$subject = htmlspecialchars(strip_tags($_POST['subject']));
	} else { // Thread ID, no need for subject.
		$subject = TRUE;
	}

	// Validate the body:
	if (!empty($_POST['body'])) {
		$body = htmlentities($_POST['body']);
	} else {
		$body = FALSE;
		echo '<p class="bg-danger">Please enter a body for this post.</p>';
	}

	if ($subject && $body) { // OK!

		// Add the message to the database...

		if (!$thread_id) { // Create a new thread.
			$q = "INSERT INTO threads (user_id, `subject`) VALUES ({$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $subject) . "')";
			$r = mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				$thread_id = mysqli_insert_id($dbc);
			} else {
				echo '<p class="bg-danger">Your post could not be handled due to a system error.</p>';
			}
		} // No $thread_id.

		if ($thread_id) { // Add this to the replies table:
			$q = "INSERT INTO posts (thread_id, user_id, message, posted_on) VALUES ($thread_id, {$_SESSION['user_id']}, '" . mysqli_real_escape_string($dbc, $body) . "', UTC_TIMESTAMP())";
			$r = mysqli_query($dbc, $q);
            echo"<br><br>";
			if (mysqli_affected_rows($dbc) == 1) {
				echo '<p class="bg-success">Your post has been entered.</p>';
			} else {
				echo '<p class="bg-danger">Your post could not be handled due to a system error.</p>';
			}
		} // Valid $thread_id.

	} else { // Include the form:
		include('includes/post_form.php');
	}

} else { // Display the form:

	include('includes/post_form.php');

}

include('includes/footer.html');
?>