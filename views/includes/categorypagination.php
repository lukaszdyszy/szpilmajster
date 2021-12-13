<?php global $controller, $action; $controllerClass = get_class($controller); ?>
<div class="newest-pagination">
	<a href="<?php echo HREF.'home/category/'.$data['category'].'/'; ?>" id="page-hidden" style="visibility: hidden;"></a>
	<?php if($data['page']-1 >= 1){ ?><a href="<?php echo HREF.'home/category/'.$data['category'].'/'.($data['page']-1); ?>" class="more-newest-btn pag-nav"><</a><?php } ?>
	<input id="page-number" type="number" 
		min="1" 
		max="<?php echo $data['pages']; ?>" 
		value="<?php echo $data['page']; ?>"
	>
	z
	<a href="<?php echo HREF.'home/category/'.$data['category'].'/'.$data['pages']; ?>"><?php echo $data['pages']; ?></a>
	<?php if($data['page']+1 <= $data['pages']){ ?><a href="<?php echo HREF.'home/category/'.$data['category'].'/'.($data['page']+1); ?>" class="more-newest-btn pag-nav">></a><?php } ?>
</div>