<h2>Edit Post</h2>

<?php foreach($posts as $post): ?>

	<h3>Your Original Post</h3>
	<!-- Show Original Post -->
    <p><?=$post['content']?> on <?=Time::display($post['modified'])?></p>
    <br>
    <!-- Display Form to Edit Post -->
	<form method='POST' action="/posts/p_edit/<?=$post['post_id']?>">

	    <h3>Your Edited Post</h3>
	    <textarea name='content' id='content'></textarea>

	    <br><br>
	    <input type='submit' value='Edit post'>

	</form> 
<?php endforeach; ?>

