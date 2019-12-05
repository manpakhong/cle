<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';
	require_once $currentDir.'php/common/HashMap.php';

	class HttpPost
	{
		
		public function __construct () {
	
		}	
		
		public function doPost($_fieldsHashMap, $_url, $_param)
		{
			$hashMap = new HashMap();
			$hashMap = $_fieldsHashMap; 
			
			$array = array();
			$array = $hashMap->getWholeArray();
	
			$postString = "";
			
			$i = 0;
			
			foreach ($array as $k => $v) {
				if ($i > 0)
				{
					$postString .= '&' . $k . '='. $v;
				}
				else 
				{
	    			$postString .= $k . '='. $v;
				}
				$i = $i + 1;
	
			}
			
			$postString .= '&' . 'param='. $_param;

			/*
			echo 'PostString: ' . $postString . '<br/>';
			echo 'url: ' . $_url . '<br/>';
			echo 'param: ' . $_param . '<br/>';
			*/
			
			// echo '<script type="text/javascript">window.location=\'' . $_url . '\'</script>';

			

			$ch = curl_init($_url);
			
			// curl_setopt($ch, CURLOPT_URL, $_url);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, 'param=\'DELETE\'');
			
			curl_exec ($ch);
			curl_close ($ch);
		}
		
		function do_post_request($_fieldsHashMap, $_url, $_param, $optional_headers = null)
		{
			$hashMap = new HashMap();
			$hashMap = $_fieldsHashMap; 
			
			$array = array();
			$array = $hashMap->getWholeArray();
	
			$data = "";
			$url = $_url;
			
			$i = 0;
			
			foreach ($array as $k => $v) {
				if ($i > 0)
				{
					$data .= '&' . $k . '='. $v;
				}
				else 
				{
	    			$data .= $k . '='. $v;
				}
				$i = $i + 1;
	
			}
			
			$data .= '&' . 'param='. $_param;			
			
			
			  $params = array('http' => array(
			              'method' => 'POST',
			              'content' => $data
			            ));
			  if ($optional_headers !== null) {
			    $params['http']['header'] = $optional_headers;
			  }
			  $ctx = stream_context_create($params);
			  $fp = @fopen($url, 'rb', false, $ctx);
			  if (!$fp) {
			    throw new Exception("Problem with $url, $php_errormsg");
			  }
			  $response = @stream_get_contents($fp);
			  if ($response === false) {
			    throw new Exception("Problem reading data from $url, $php_errormsg");
			  }
			  return $response;
		}
		
		
	}
?>