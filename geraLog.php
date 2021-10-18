<?php
	function logMsg( $msg, $nivel, $arquivo )
	{
		// variavel que vai armazenar o nivel do log (INFO, WARNING ou ERROR)
		$nivelStr = '';
	 
		// verifica o nivel do log
		switch ( $nivel )
		{
			case 'info':
				// nivel de informacao
				$nivelStr = 'INFO';
				break;
	 
			case 'warning':
				// nivel de aviso
				$nivelStr = 'WARNING';
				break;
	 
			case 'error':
				// nivel de erro
				$nivelStr = 'ERROR';
				break;
		}
	 
		// data atual
		date_default_timezone_set('America/Sao_Paulo');
		$data = date( 'Y-m-d H:i:s' );
	 		
		$msg = sprintf( "[%s] [%s]: %s%s", $data, $nivelStr, $msg, PHP_EOL );
	 		
		file_put_contents( $arquivo, $msg, FILE_APPEND );
	}
?>