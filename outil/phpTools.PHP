<?php

	function verifParam($nomParam,$method){
		switch ($method) {
			case "GET" :
				if (!isset($_GET[$nomParam])) return false;
				else if ($_GET[$nomParam]=="") return false;
				break;
			case "POST" :
				if (!isset($_POST[$nomParam])) return false;
				else if ($_POST[$nomParam]=="") return false;
				break;
		}
		return true;
	}

?>