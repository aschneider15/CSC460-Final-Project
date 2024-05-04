<?php
// This page shows the form for posting messages.
// It's included by other pages, never called directly.

// Only display this form if the user is logged in:
if (isset($_SESSION['user_id'])) {

	// Display the form:
	echo '<form action="post.php" method="post" accept-charset="utf-8">';

	// If on read.php...
	if (isset($thread_id) && $thread_id) {

		// Print a caption:
		echo '<h3>Post a Reply</h3>';

		// Add the thread ID as a hidden input:
		echo '<input name="thread_id" type="hidden" value="' . $thread_id . '">';

	} else { // New thread

		// Print a caption:
		echo '<h3>New Thread</h3>';

		// Create subject input:
		echo '<div class="form-group"><label for="subject">Subject</label> <input name="subject" type="text" class="form-control" size="60" maxlength="100" ';

		// Check for existing value:
		if (isset($subject)) {
			echo "value=\"$subject\" ";
		}

		echo '></div>';

	} // End of $thread_id IF.

	// Create the body textarea:
	echo '<div class="form-group"><label for="subject">Body</label> <textarea name="body" class="form-control" rows="10" cols="60">';

	if (isset($body)) {
		echo $body;
	}

	echo '</textarea></div>';

	// Finish the form:
	echo '<input name="submit" type="submit" class="form-control" value="Submit">
	</form>';

} else {
	echo '<p class="bg-warning">You must be logged in to post messages.</p>';
}

?>