<h2>The following bird sightings have been observed</h2>
<ul>
	<?php foreach($posts as $post): ?>
	    <li>
	    	<strong><?=$post['first_name']?> <?=$post['last_name']?> posted:</strong>
	    	<br>
	    	<?=$post['content']?>
	    	<br>
			<span class = "date">
		    	<time datetime="<?=Time::display($post['created'],'Y-m-d G:i')?>">
		        	<?=Time::display($post['created'])?>
		    	</time>
	    	</span>	    
	    </li>
	<?php endforeach; ?>
</ul>