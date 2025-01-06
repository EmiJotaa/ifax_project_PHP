<?=$this->fetch('commons/header.php', $data)?>

<?=$this->fetch('commons/slider_banner.php', $data)?>
<?=$this->fetch('commons/quem_somos.php', $data)?>
<?=$this->fetch('commons/call_to_action.php', $data)?>

<?php if (!empty($data['informacoes']['listaNoticias'])): ?>
    <?=$this->fetch('commons/noticias.php', $data)?>
<?php endif ?>

<?php if (!empty($data['informacoes']['listaProjetos'])): ?>
    <?=$this->fetch('commons/projetos.php', $data)?>
<?php endif ?>

<?php if (!empty($data['informacoes']['listaFotos'])): ?>
    <?=$this->fetch('commons/fotos.php', $data)?>
<?php endif ?>

<?php if (!empty($data['informacoes']['listaVideos'])): ?>
    <?=$this->fetch('commons/videos.php', $data)?>
<?php endif ?>

<?=$this->fetch('commons/footer.php', $data)?>
