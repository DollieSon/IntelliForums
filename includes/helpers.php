<?php
function createForumHeader($title, $username, $date, $commentCount, $latestCmDate, $latestCmUsername)
{
    echo "<div class='forumHeader'>";
    echo "<div class ='fhTitle'>";
    echo "<h2>$title</h2>";
    echo "<div class='fhInfo'>";
    echo "<p>Posted by: $username</p>";
    echo "<p>Date: $date</p>";
    echo "</div>";
    echo "</div>";
    echo "<div class='fhComments'>";
    echo "<p>Comments</p>";
    echo "<p>$commentCount</p>";
    echo "</div>";
    echo "<div class='fhLatestComment'>";
    echo "<p>Latest Comment</p>";
    echo "<p>$latestCmUsername</p>";
    echo "<p>$latestCmDate</p>";
    echo "</div>";
    echo "</div>";
}

?>