<?=$this->fetch('commons/header.php', $data)?>
<?=$this->fetch('commons/caminho.php', $data)?>

<?=$this->fetch('commons/noticia.php', $data)?>

<?php if (!empty($data['informacoes']['listaGaleria'])): ?>
    <?=$this->fetch('commons/galeria1.php', $data)?>
<?php endif ?>

<?=$this->fetch('commons/footer.php', $data)?>