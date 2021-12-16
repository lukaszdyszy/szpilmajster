<?php include(VIEW.'includes/header.php');?>

<main class="page-content">
  <div class="container">
    <h1>Zarządzanie</h1>

    <?php
    print_r($_SESSION["POG"]); ?>

    <h4>użytkownicy</h4>
    <div class="admin_users">
      <?php foreach ($data['users'] as $key => $user): ?>
        <div class="admin_user">
          <?php echo $user['name']; ?>
          <form class="" action="<?php echo HREF; ?>admin/setRole/<?php echo $user['id']; ?>" method="get">
            rola: <input type="number" name="role" value="<?php echo $user['role'] ?>">
            <input type="submit" name="sub" value="ustaw">
          </form>
        </div>
      <?php endforeach; ?>
    </div><br>

    <h4>Artykuły</h4>
    <div class="admin_articles">
      <?php if($data['listed']){ foreach ($data['listed'] as $key => $art): ?>
        <div class="admin_art">
          <a href="<?php echo HREF; ?>single/read/<?php echo $art['id'] ?>"><?php echo $art['title']; ?></a>
          <div style="display: inline-block; float: right;">
            <a href="<?php echo HREF; ?>admin/remove/<?php echo $art['id'] ?>">usuń</a>
          </div>
          <div style="display: inline-block; float: right; margin-right: 5px;"> 
				<a href="<?php echo HREF.'admin/togglerecommended/'.$art['id']; ?>">dodaj do polecanych</a>
			</div>
          <div style="display: inline-block; float: right; margin-right: 5px;"> <?php echo $art['author']; ?> </div>
        </div>
      <?php endforeach; } ?>
    </div><br>

	<h4>Polecane</h4>
    <div class="admin_articles">
      <?php if($data['recommended']){ foreach ($data['recommended'] as $key => $art): ?>
        <div class="admin_art">
          <a href="<?php echo HREF; ?>single/read/<?php echo $art['id_article'] ?>"><?php echo $art['title']; ?></a>
          <div style="display: inline-block; float: right;">
            <a href="<?php echo HREF.'admin/togglerecommended/'.$art['id_article']; ?>">usuń z polecanych</a>
          </div>
          <div style="display: inline-block; float: right; margin-right: 5px;"> <?php echo $art['author']; ?> </div>
        </div>
      <?php endforeach; } ?>
    </div><br>
  </div>
</main>
