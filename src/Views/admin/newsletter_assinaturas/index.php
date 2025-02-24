<?=$this->fetch('commons/header.php', $data)?>
<main>
	<section class="dashboard">
		<div class="container">
			<div class="conteudo">
				<h2 class="titulo">
					<i class="fas fa-users"></i>Newsletter - Assinaturas cadastradas
				</h2>
				<div class="topo">
					<div class="botoes">
						<a href="<?=URL_BASE?>admin-newsletter-assinaturas-create" class="btn">Cadastrar Nova</a>						
					</div>
					<div class="pesquisa">
						<form action="#" method="GET">
							<input type="text" name="search" value="<?=(isset($_GET['search'])) ? $_GET['search'] : ''?>" placeholder="Nome do assinante...">
							<input type="submit" value="Pesquisar" class="btn">
						</form>
					</div>
				</div>
				<div class="lista">
					<table>
						<thead>
							<tr>
								<td>ID</td>
								<td>AÇÕES</td>
								<td>EMAIL</td>
								<td>NOME</td>								
								<td>DATA DE CADASTRO</td>
							</tr>
						</thead>
						<tbody>
							<?php						      
						    if($data['informacoes']['listagem']){
						        foreach ($data['informacoes']['listagem'] as $newsletter) { ?>
						        	<tr>
										<td><?=$newsletter['id']?></td>
										<td>
											<a href="<?=URL_BASE?>admin-newsletter-assinaturas-edit/<?=$newsletter['id']?>"><i class="far fa-edit"></i></a>
											<a href="<?=URL_BASE?>admin-newsletter-assinaturas-delete/<?=$newsletter['id']?>"><i class="far fa-trash-can"></i></a>
										</td>
										<td><?=$newsletter['email']?></td>
										<td><?=$newsletter['nome']?></td>
										<td><?= date('d/m/Y', strtotime($newsletter['data_cadastro']))?></td>
									</tr>		
						    <?php   }
						    }
							?>
						</tbody>
					</table>
				</div>
				<div class="paginacao">
					<?php if(isset($data['informacoes']['paginaAnterior']) && $data['informacoes']['paginaAnterior'] !== false){ ?>
						<a href="<?=$data['informacoes']['paginaAnterior']?>"><i class="fas fa-arrow-left"></i></a>
					<?php }?>
									
					<a><?=$data['informacoes']['paginaAtual']?></a>
				 
					<?php if(isset($data['informacoes']['proximaPagina']) && $data['informacoes']['proximaPagina'] !== false){ ?>
						<a href="<?=$data['informacoes']['proximaPagina']?>"><i class="fas fa-arrow-right"></i></a>
					<?php }?>
				</div>
			</div>
		</div>
	</section>
</main>
<?=$this->fetch('commons/footer.php', $data)?>