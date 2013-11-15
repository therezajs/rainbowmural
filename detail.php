<?php
	session_start();
	include('connection.php');
    require('header.php');

    // $comment = Comment::currentUser();

?>
    <style type="text/css">
        #container {
            margin-top: 70px;
        }
    </style>
    <div class="container" id='container'>
        <div class='row'>
            <div class='col-md-6' id='pic'>
                <img src="http://www.flickr.com/photos/230680155_844662f4dd.jpg">
            </div>
            <div class='col-md-6'>
                <h3>Title of Pic</h3>
                <div id='google_maps'></div>
                <div id='comments'>
                    <ul>
                        <li>like</li>
                        <li>comment</li>
                    </ul>
                    <?php
                    // function commentsTable($comments)
                    // {
                    //     $html = "<table class='table table-bordered'><tbody>";
                    //     foreach($comments as $comment)
                    //     {
                    //         $html .= "<tr><td>".$comment->name."</td>";
                    //         $html .= "<td>".$comment->comment."</td>";
                    //     }
                    //     $html .= "</tbody></table>";
                    //     echo $html;
                    // }
                    // $comments = $comment->getComments();

                    // commentsTable($comments);

                    ?>



                    <form action='comment.php' method='post'>
                        <input type='hidden' name='say_comment' value=<?php  ?> >
                        <textarea name='comment'></textarea>
                        <input type='submit' value='Say It' class='btn btn-primary'>
                    </form>
                </div>
            </div>
        </div>

    </div>
</body>
</html>