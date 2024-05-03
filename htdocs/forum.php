<?php
$page_title = 'Forums';
require('includes/header.html');
require('../mysqli_connect.php');

echo '<h1>Forums</h1>
    <a href="create_forum.php">Create a New Forum</a>';

// Retrieve all the messages in this forum...

// The query for retrieving all the threads in this forum, along with the original user,
// when the thread was first posted, when it was last replied to, and how many replies it's had:
$q = "SELECT forum_id, forum_name, creat_date, forum_desc FROM forums";
$r = mysqli_query($dbc, $q);
if (mysqli_num_rows($r) > 0) {

    // Create a table:
    echo '<table class="table table-striped">
	<thead>
		<tr>
			<th>Forum Title</th>
            <th>Forum Description</th>
            <th>Creation Date</th>
		</tr>
	</thead>
	<tbody>';

    // Fetch each thread:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        // <td><a href="read.php?tid=' . $row['thread_id'] . '">' . $row['subject'] . '</a></td>

        echo '<tra>
				<td>' . $row['forum_name'] . '</td>
                <td>' . $row['forum_desc'] . '</td>
				<td>' . $row['creat_date'] . '</td>
			</tr>';
    }

    echo '</tbody></table>'; // Complete the table.

} else {
    echo '<p>There are currently no forums.</p>';
}

// Include the HTML footer file:
include('includes/footer.html');
