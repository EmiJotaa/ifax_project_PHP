<?=$this->fetch('commons/header.php', $data)?>
<?=$this->fetch('commons/caminho.php', $data)?>

<?=$this->fetch('commons/projeto.php', $data)?>

<?php if (!empty($data['informacoes']['listaGaleria'])): ?>
    <?=$this->fetch('commons/galeria.php', $data)?>
<?php endif ?>

<?=$this->fetch('commons/footer.php', $data)?>