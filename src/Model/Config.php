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
	public static function getConfig($nome)
	{
		$sql = new Sql();

		$consulta = "SELECT * FROM config WHERE nome = '".$nome."' LIMIT 1";

		$retorno = $sql->querySelect($consulta);

		if (count($retorno) <= 0) {
			return false;
		}else{
			return $retorno[0]['valor'];
		}
	}
}