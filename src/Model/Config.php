<?php 
namespace App\Model;

use App\Model\Model;

class Config extends Model {
	
	private $table = "config";
	protected $fields = [
		"id",
		"nome",
		"valor",
		"data_cadastro",
		"data_atualizacao"
	];

	function insertConfig($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateConfig($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteConfig($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectConfig($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	
	function selectConfigsPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectConfigsPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE nome LIKE '%".$pesquisa."%' OR valor LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}