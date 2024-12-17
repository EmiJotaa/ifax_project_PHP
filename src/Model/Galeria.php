<?php 
namespace App\Model;

use App\Model\Model;

class Galeria extends Model {
	
	private $table = "galeria";
	protected $fields = [
		"id",
		"id_projeto",
		"caminho",
		"data_cadastro",
	];

	function insertGaleria($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateGaleria($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteGaleria($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectGaleria($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	
	function selectGaleriasPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectGaleriasPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE titulo LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}