<?php
// This page shows the messages in a thread.
include('includes/header.html');
require('../mysqli_connect.php');

// Check for a thread ID...
$thread_id = FALSE;
if (isset($_GET['thread_id']) && filter_var($_GET['thread_id'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {

	// Create a shorthand version of the thread ID:
	$thread_id = $_GET['thread_id'];
    $posted = 'p.posted_on';

	// Run the query:
	$q = "SELECT t.subject, p.message, u.first_name, u.last_name, DATE_FORMAT($posted, '%e-%b-%y %l:%i %p') AS posted FROM threads AS t LEFT JOIN posts AS p USING (thread_id) INNER JOIN users AS u ON p.user_id = u.user_id WHERE t.thread_id = $thread_id ORDER BY p.posted_on ASC";
	$r = mysqli_query($dbc, $q);
	if (!(mysqli_num_rows($r) > 0)) {
		$thread_id = FALSE; // Invalid thread ID!
	}

} // End of isset($_GET['thread_id']) IF.

if ($thread_id) { // Get the messages in this thread...

	$printed = FALSE; // Flag variable.

	// Fetch each:
	while ($messages = mysqli_fetch_array($r, MYSQLI_ASSOC)) {

		// Only need to print the subject once!
		if (!$printed) {
			echo "<h2>{$messages['subject']}</h2>\n";
			$printed = TRUE;
		}

		// Print the message:
		echo "<p>{$messages['first_name']} {$messages['last_name']} ({$messages['posted']})<br>{$messages['message']}</p><br>\n";

	} // End of WHILE loop.

	// Show the form to post a message:
	include('includes/post_form.php');

} else { // Invalid thread ID!
	echo '<p class="bg-danger">This page has been accessed in error.</p>';
}

include('includes/footer.html');
?>