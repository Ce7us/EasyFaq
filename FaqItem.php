<?php

/** 
 * almacena los elementos individuales  de la faq
 * 
 * 
 * ejemplo de uso:
 * FaqItem("the ultimate answer to life, the universe, and everithing","42")
 * @author Juan Antonio Orozco Bianchi <cetus@ka-plum.co.cc>
 * @package EasyFaq
 * @category container
 * @version 1.0
 */
class FaqItem {
	
	

	/**
	 * constructor
	 * 
	 * 
	 * inicializa el objeto
	 * @param string $question
	 * @param string $answer
	 * @since 1.0
	 */
	function __construct($question,$answer) {
		
		$this->Pregunta=$question;
		$this->respuesta=$answer;
		

	}
	
	/**
	 * 
	 */
	function __destruct() {
	

	}
	
	public $Pregunta;
	public $respuesta;
}

?>