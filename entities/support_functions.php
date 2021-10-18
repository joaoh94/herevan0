<?php
	function hasError($variable){
	    
		if(isset($_SESSION['erros']) && is_array($_SESSION['erros']) && in_array($variable, $_SESSION['erros']))
		  return true;

		return false;
	}
?>