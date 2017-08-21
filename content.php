//Para mostrar las taxonomías antes del contenido

if('servicios'==get_post_type()) { ?>

<div class="taxonomia">
<div class="categoria">

<?php echo get_the_term_list($post->ID,'categoria', "Categorías: ", ','); ?>
</div>
</div>
