<?php
	session_start();
	require("header.php");
	require_once("Database.php");
	require('Fav.php');

?>
	<style type="text/css">

        #search {
            margin: 10px auto;
        }
        #container {
            margin-top: 20px;
        }
        .item {
            width: 33%;
        }
        .item img {
            width: 100%;
            padding: 8px;
        }
        .button {
            min-width: 250px;
            height: 50px;
            margin: 10px;
        }
    </style>
	<div class='container'>
	<?php
		flash();
	?>
	<h2>List of liked Street Art</h2>
	<div class='row' id='like_container'>
	<?php
	if (isset($_SESSION['id']))
	{
		$data = new Fav();
		$likes = $data->getLikes($_SESSION['id']);

		// var_dump($likes);
		if (!empty($likes))
		{
			foreach ($likes as $like) {
				echo '<div class="item" ><a href="detail.php?lat=' . $like['lat'] . '&lon=' . $like['lon'] . '&id=' . $like['pic_id'] . '&secret=' . $like['pic_secret'] . '"><img src="http://www.flickr.com/photos/'.$like['pic_id'].'_'.$like['pic_secret'].'.jpg"></a></div>';
			}
		}
		else
		{
			echo "<h2>No likes set yet</h2>";
		};
	}
	else
	{
		echo "<h2>Please log in to see your likes</h2>";
	};

	?>
	</div>
	<script type="text/javascript">
        $(window).load(function() {
            var container = document.querySelector('#like_container');
            var msnry = new Masonry( container, {
              itemSelector: '.item'
            });

        });
    </script>



	</div>
</body>
</html>