<?php
$page_title = 'Forums';
require('includes/header.html');
require('../mysqli_connect.php');

echo '<h1>Threads</h1>
    <a href="post.php">Create a New Thread</a>';

// Retrieve all the messages in this forum...

// The query for retrieving all the threads in this forum, along with the original user,
// when the thread was first posted, when it was last replied to, and how many replies it's had:
$q = "SELECT `thread_id`, `subject`, `created` FROM threads";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {

    // Create a table:
    echo '<table class="table table-striped">
	<thead>
		<tr>
			<th>Thread Subject</th>
            <th>Date Created</th>
		</tr>
	</thead>
	<tbody>';

    // Fetch each thread:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        // <td><a href="read.php?thread_id=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>

        echo '<tra>
                <td><a href="read.php?thread_id=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>
                <td>' . $row['created'] . '</td>
			</tr>';
    }

    echo '</tbody></table>'; // Complete the table.

} else {
    echo '<p>There are currently no threads.</p>';
}

// Include the HTML footer file:
include('includes/footer.html');
