<?php
include 'db_include.php';
doDB();

// gather the topics
$get_topics_sql = "SELECT topic_id, topic_title, DATE_FORMAT(topic_create_time, '%b %e %Y at %r') AS fmt_topic_create_time, topic_owner 
FROM forum_topics ORDER BY topic_create_time DESC";

$get_topics_res = mysqli_query($mysqli, $get_topics_sql) or die(mysqli_error($mysqli));

if (mysqli_num_rows($get_topics_res) < 1) {
    // there are not topics, so say so
    $display_block = "<p><em>No topics exist.</em></p>";
} else {
    // create the display string
    $display_block = <<<END_OF_TEXT
    <table id="myTable">
    <thead>
    <tr>
    <th><a href="javascript:sortTable(myTable,0,0);">TOPIC TITLE</a></th>
    <th><a href="javascript:sortTable(myTable,1,0);"># of POSTS</a></th>
    </tr>
    </thead>
    <tbody>
    END_OF_TEXT;

    while ($topic_info = mysqli_fetch_array($get_topics_res)) {
        $topic_id = $topic_info['topic_id'];
        $topic_title = stripslashes($topic_info['topic_title']);
        $topic_create_time = $topic_info['fmt_topic_create_time'];
        $topic_owner = stripslashes($topic_info['topic_owner']);

        // get number of posts
        $get_num_posts_sql = "SELECT COUNT(post_id) AS post_count FROM
        forum_posts WHERE topic_id = '".$topic_id."'";

        $get_num_posts_res = mysqli_query($mysqli, $get_num_posts_sql) or die(mysqli_error($mysqli));

        while ($posts_info = mysqli_fetch_array($get_num_posts_res)) {
            $num_posts = $posts_info['post_count'];
        }

        // add to display
        $display_block .= <<<END_OF_TEXT
        <tr>
        <td><a href="showtopic.php?topic_id=$topic_id">
        <strong>$topic_title</strong></a><br/>
        Created on $topic_create_time by $topic_owner</td>
        <td class="num_posts_col">$num_posts</td>
        </tr>
        END_OF_TEXT;
    }

    // free results
    mysqli_free_result($get_topics_res);
    mysqli_free_result($get_num_posts_res);

    // close connection to MySQL
    mysqli_close($mysqli);

    // clos up the table
    $display_block .= "</tbody></table>";

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Topics in My Forum</title>  
    <link rel="icon" href="images/devtools.png" type="image/x-icon">
    <link rel="stylesheet" href="styles/reset.css">
    <link rel="stylesheet" href="styles/discuss.css">
    <script type="text/javascript">
        function sortTable(table, col, reverse) {
            var tb = table.tBodies[0];
            var tr = Array.prototype.slice.call(tb.rows,0);
            var i;
            reverse = -((+reverse) || -1);
            tr = tr.sort(function (a,b) {
                return reverse // '-1 *' if want opposite order
                * (a.cells[col].textContent.trim().localeCompare(b.cells[col].textContent.trim()));
            });
            for(i=0; i < tr.length; ++i) tb.appendChild(tr[i]);
        }

        // sortTable(tableNode, columnId, false);
     
    </script>

</head>
<body>

    <main>
        <h1 id="banner">Topics in My Forum</h1>
        <section id="content">
            <?php echo $display_block ?>
            <div id="nav">
                <p>Would you like to 
                <a href="addtopic.html">add a topic?</a></p>
                <a href="/"><button id="home">Home</button></a>
            </div>
        </section>      
    </main>


</body>
</html>