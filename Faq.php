<?php

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
		$this->coneccion = mysql_connect($host,$usr,$psw);
		mysql_select_db($db,$this->coneccion);
		
		$this->count = 0;
		$this->items = array(); //un array vacio por ahora;
	}
	
	/**
	 * 
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
	 */
	public function PrintFaqs($mensaje)
	{ 
		echo '<!-- generado por EasyFaq-->/n <div class="faq">\n';//porfavor no remueva esta linea
		
			if(count==0)
			{
				echo "<div id=\"error\">$mensaje</div>";
			}
			else
				foreach($this->items as $item)
				{
					
					echo "<div class\"pregunta\">$item->Pregunta</div><div class=\"pregunta\">$item->respuesta</div>";
					
				}
		
		
		echo '</div>/n<!--fin EasyFaq-->/n';//tampoco remueva esta
		
		return $this->count != 0;
		
	}
	
	
	
	/**
	 * 
	 * a–ade un nuevo elemento a la lista y a la bd
	 * @param string $pregunta
	 * @param string $respuesta
	 */
	public  function AddFaq($pregunta,$respuesta)
	{
		$newFaq = new FaqItem($pregunta, $respuesta);
		$this->items[]= $newFaq;
		$query = mysql_real_escape_string("insert into EasyFaqData (question,answer) values ($pregunta,$respuesta)");
		mysql_query($query,$this->coneccion);
	}
	
	/**
	 * 
	 * carga las faq desde la base de datos
	 * 
	 */
	
	public function load()
	{
		$query = "select question,answer from EasyFaqData order by id dsc";
		
		$result = mysql_query($query,$this->coneccion);
		foreach(mysql_fetch_object($result,FaqItem) as $object)
		{
			$this->items[]=$object;
		}
		
	}
	
	private	$coneccion;
	private $count;
	private $items;
		
}

?>