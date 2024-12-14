<?php 
namespace App\Model;

use App\Model\Model;

class Noticia extends Model {
	
	private $table = "noticias";
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

	function insertNoticia($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateNoticia($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteNoticia($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectNoticia($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}
	function getUltimoNoticia()
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT 1";
		return $this->querySelect($sql)[0];
	}
 
	function insertFotoGaleria($campos)
	{
		$this->insert('galeria1', $campos);
	}

	function selectGaleriaNoticia($campos, $where):array
	{
		return $this->select('galeria1', $campos, $where);
	}
	function deleteImagemGaleria($coluna, $valor)
	{
		$this->delete('galeria1', $coluna, $valor);
	}
	function selectNoticiasPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectNoticiasPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE titulo LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}