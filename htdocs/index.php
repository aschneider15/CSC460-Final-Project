<?php

// This function outputs theoretical HTML
// for adding ads to a Web page.
function create_ad()
{
    echo '<div class="alert alert-info" role="alert"><p>This is an annoying ad! This is an annoying ad! This is an annoying ad! This is an annoying ad!</p></div>';
} // End of the function definition.

$page_title = 'Welcome to the Final Site!';
include('includes/header.html');

?>
<div class="page-header">
    <h1>Welcome to the Final Project's Website!</h1>
</div>
<p>Please consider creating an account to participate in forum-based discussion.</p>
<p>Otherwise, feel free to just hang out here... though I'm afraid it's not going to be too engaging.</p>

<?php

include('includes/footer.html');
?>