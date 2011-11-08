<?php

include_once 'FaqItem.php' or die("erorr fatal");

/** 
 * lista de faq
 * 
 * 
 * recupera,almacena e imprime las faqs de la base de datos especificada por el usuario
 * 
 * uso:  
 * Faq("root","toor","localhost","myDb");
 * @author Juan Antonio Orozco Bianchi
 * @package EasyFaq
 * @category list
 * @access public
 * @uses FaqItem
 * @version 1.0
 */

class Faq {
	
	/**
	 * inisialisa la clase y la coneccion a la bd
	 * @param string $usr usuario de la base de datos
	 * @param string $psw
	 * @param string $host
	 * @param string $db
	 */
	function __construct($usr,$psw,$host,$db) {
		$this->coneccion = mysql_connect($host,$usr,$psw) or die("error de conexion") ;
		mysql_select_db($db,$this->coneccion);
		
		$this->count = 0;
		$this->items = array(); //un array vacio por ahora;
	}
	
	/**
	 * limpia la memoria
	 */
	function __destruct() {
		mysql_close($this->coneccion);
		
		foreach($this->items as &$item){
			unset($item); //php no tiene un delete, pero usa un garbage colector
		}
	
	}
	
	
	
	/**
	 * 
	 * imprime las faqs en el formato <div class="faq"><div class="pregunta"> pregunta</div> <div class="respuesta"> respuesta</div> </div> en caso de error imprime <div class="error"></div>
	 * 
	 * @return bool : false si ocurre un error / true si todo salio bien
	 * @param string $mensaje mensaje a imprimir si no hay elementos
	 * @param string $adminPage [Opcional] si esta definida activa las funciones administrativas
	 */
	public function PrintFaqs($mensaje,$adminPage)
	{ 
		echo '<!-- generado por EasyFaq-->/n <div class="faq">\n';//porfavor no remueva esta linea
		
			if(count==0)
			{
				echo "<div id=\"error\">$mensaje</div>";
			}
			else
				foreach($this->items as $item)
				{
					
					echo "<div class=\"Row\"><div class=\"pregunta\">$item->Pregunta</div><div class=\"pregunta\">$item->respuesta</div>". (isset($adminPage)) ? " <div class=\"delete\"><a href=\"$adminPage?borrar&id=$item->id\">borrar</a></div> <div class=\"delete\"><a href=\"$adminPage?borrar\">modificar&id=$item->id</a></div>" : ""."</div>";
					
				}
		
		
		echo '</div>/n<!--fin EasyFaq-->/n';//tampoco remueva esta
		
		return $this->count != 0;
		
	}
	
	/**
	 * busca y regresa un item de la lista o null si no se encontro
	 * 
	 * @param int $id
	 * @return FaqItem
	 */	
	public function getId(int $id)
	{
		foreach($this->items as $item)
		{
			if($item->id == $id)
				return $item;
		}
			
		return null;
		
	}
	
	
	
	/**
	 * 
	 * añade un nuevo elemento a la lista y a la bd
	 * @param string $pregunta
	 * @param string $respuesta
	 */
	public  function AddFaq($pregunta,$respuesta)
	{
		$this->items[]= new FaqItem($pregunta, $respuesta);
		$query = mysql_real_escape_string("insert into EasyFaqData (question,answer) values ('$pregunta','$respuesta')");
		mysql_query($query,$this->coneccion);
	}
	
	
	/**
	 * elimina un elemento presente, regresa false si no existe el elemento
	 * 
	 * @param int $id
	 * @return boolean
	 */
	public  function delFaq(int $id)
	{
		if($this->getId($id) != null)
		{
			$query = mysql_real_escape_string("delete from EasyFaqData where id=$id");
			mysql_query($query,$this->coneccion);
			
			return true;			
		}
		
		return false;
	}
	
	
	/**
	 * 
	 * carga las faq desde la base de datos
	 * 
	 */
	
	public function load()
	{
		$query = "select id,question,answer from EasyFaqData order by id";
		
		$result = mysql_query($query,$this->coneccion);
		foreach(mysql_fetch_object($result,FaqItem) as $object)
		{
			$this->items[]=$object;
		}
		
	}
	
	/**
	 * regresa el numero de elementos presentes 
	 * 
	 * @return int Count
	 */	
	public function getCount()
	{
		return $this->count;
	}
	
	
	/**
	 * regresa el id del ultimo elemento en la lista
	 * 
	 * @return int lastId
	 */
	public function getLastId()
	{
		return $this->lastId;
	}
	
	private	$coneccion;
	private $count;
	private $items;
	private $lastId;
		
}

?>