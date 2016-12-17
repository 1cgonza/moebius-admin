<?php
  $users = get_moebius_users();
  $authors = $users['authors'];
  $groups = $users['groups'];
?>
<form method="post">
  <?php /*----------  EQUIPO PRINCIPAL  ----------*/ ?>
  <?php if ( array_key_exists($groups['principal'], $authors) ) : ?>
    <h2 class="group-title">Equipo Principal</h2>
    <div id="list-equipo-principal">
    <?php foreach ($authors[$groups['principal']] as $index => $author) : ?>
      <div class="moebius-users-order-item">
        <p class="moebius-user-img"><?php echo wp_get_attachment_image($author['img'], 'thumbnail'); ?></p>
        <p class="moebius-user-name"><?php echo $author['name']; ?></p>
        <input name="<?php echo $author['ID']; ?>" value="<?php echo $index; ?>" type="hidden" class="moebius-user-field"></input>
      </div>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>
  <?php /*----------  COLABORADORES  ----------*/ ?>
  <?php if ( array_key_exists($groups['colaborators'], $authors) ) : ?>
    <h2 class="group-title">Colaboradores</h2>
    <div id="list-colaboradores">
    <?php foreach ($authors[$groups['colaborators']] as $index => $author) : ?>
      <div class="moebius-users-order-item">
        <p class="moebius-user-img"><?php echo wp_get_attachment_image($author['img'], 'thumbnail'); ?></p>
        <p class="moebius-user-name"><?php echo $author['name']; ?></p>
        <input name="<?php echo $author['ID']; ?>" value="<?php echo $index; ?>" type="hidden" class="moebius-user-field"></input>
      </div>
    <?php endforeach; ?>
    </div>
  <?php endif; ?>
    <p><input class="button-primary" type="submit" value="Update"/></p>
  </form>