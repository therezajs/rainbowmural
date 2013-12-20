<?php
	session_start();
	require("header.php");
	require_once("Database.php");
	require('Fav.php');

?>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on("mouseenter", ".item", function(){
                $(this).find("p").css("color", "white");
                $(this).find("span").css("color", "white");
            });

            $(document).on("mouseleave", ".item", function(){
                $("p").css("color", "transparent");
                $(this).find("span").css("color", "transparent");
            });
})

</script>
<div class='container' id="my_container">
	<?php
		flash();
	?>
	<h2>Likes</h2>
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
				echo '<div class="item" ><a href="detail.php?lat=' . $like['lat'] . '&lon=' . $like['lon'] . '&id=' . $like['pic_id'] . '&secret=' . $like['pic_secret'] . '"><img src="http://www.flickr.com/photos/'.$like['pic_id'].'_'.$like['pic_secret'].'.jpg"></a><p>'.$like['title'].'</p></div>';
			}
		}
		else
		{
			echo "<h3> No likes set yet</h3>";
		};
	}
	else
	{
		echo "<h3>Please log in to see your likes</h3>";
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
<?php require('footer.php'); ?>
