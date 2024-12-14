<?php 
namespace App\Model;

use App\Model\Model;

class Projeto extends Model {
	
	private $table = "projetos";
	protected $fields = [
		"id",
		"titulo",
		"url_amigavel",
		"descricao",
		"imagem_principal",
		"status",
		"data_cadastro",
		"data_atualizacao"
	];

	function insertProjeto($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateProjeto($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteProjeto($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectProjeto($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	function getUltimoProjeto()
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT 1";
		return $this->querySelect($sql)[0];
	}
 
	function insertFotoGaleria($campos)
	{
		$this->insert('galeria', $campos);
	}

	function selectGaleriaProjeto($campos, $where):array
	{
		return $this->select('galeria', $campos, $where);
	}
	function deleteImagemGaleria($coluna, $valor)
	{
		$this->delete('galeria', $coluna, $valor);
	}
	function selectProjetosPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectProjetosPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE titulo LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}