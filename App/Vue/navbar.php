<?php ob_start()?>
<?php if(isset($_SESSION['connected'])):?>
<ul>
    <li><a href=./>Accueil</a></li>
</ul>
<?php else:?>
<ul>
    <li><a href=./>Accueil</a></li>
</ul>
<?php endif;?>
<?php $navbar = ob_get_clean()?>
