<?php 
namespace App\Model;

use App\Model\Model;

class Foto extends Model {
	
	private $table = "fotos";
	protected $fields = [
		"id",
		"titulo",
		"imagem_principal",
		"status",
		"data_cadastro",
		"data_atualizacao"
	];

	function insertFoto($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateFoto($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteFoto($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectFoto($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	
	function selectFotosPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectFotosPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE titulo LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}