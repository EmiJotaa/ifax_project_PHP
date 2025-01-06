<?php 
namespace App\Model;

use App\Model\Model;

class NewsletterListagem extends Model {
	
	private $table = "newsletterlistagem";
	protected $fields = [
		"id",
		"titulo",
		"autor",
		"descricao",
		"imagem_principal",
		"data_cadastro",
		"data_atualizacao"
	];

	function insertNewsletterListagem($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateNewsletterListagem($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteNewsletterListagem($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectNewsletterListagem($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}

	function getUltimoNewsletterListagem()
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT 1";
		return $this->querySelect($sql)[0];
	}

	function selectNewsletterListagemsPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectNewsletterListagemsPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE titulo LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}
}