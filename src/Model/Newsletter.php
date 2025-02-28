<?php 
namespace App\Model;

use App\Model\Model;

class Newsletter extends Model {
	
	private $table = "newsletter";
    protected $fields = [
        "id",
        "nome",
        "email",
        "data_cadastro"
    ];

	function insertNewsletter($campos)
	{
		$this->insert($this->table, $campos);
	}

	function updateNewsletter($valores, $where)
	{	
		$this->update($this->table, $valores, $where);
	}

	function deleteNewsletter($coluna, $valor)
	{
		$this->delete($this->table, $coluna, $valor);
	}

	function selectNewsletter($campos, $where):array
	{
		return $this->select($this->table, $campos, $where);
	}

	function emailExiste($email)
    {
        $resultado = $this->selectNewsletter(["id"], ["email" => $email]);
        return !empty($resultado); // Se encontrar, retorna true
    }

    function selectNewslettersPage($limit, $offset)
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT ".$offset.", ".$limit;
 
		return $this->querySelect($sql);
	}
 
	function selectNewslettersPesquisa($pesquisa)
	{
		$sql = "SELECT * FROM ".$this->table." WHERE nome LIKE '%".$pesquisa."%' ORDER BY id DESC";
 
		return $this->querySelect($sql);
	}

		function getUltimoNewsletter()
	{
		$sql = "SELECT * FROM ".$this->table." ORDER BY id DESC LIMIT 1";
		return $this->querySelect($sql)[0];
	}
}