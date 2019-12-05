<?php
	$currentDir = getcwd();
	$findRootDirPos = strpos($currentDir, 'cle', 0);
	$currentDir =  substr_replace($currentDir, '' , $findRootDirPos + 3);

	$currentDir = $currentDir . '/';


	require_once( $currentDir.'php/command/CleUserCmd.php' );
	require_once( $currentDir.'php/vo/CleUser.php' );
	require_once( $currentDir.'php/vo/CleUserFilter.php' );

    
    class UserLogin
    {
    	private $cleUser;
    	private $cleUserList;
    	
    	public function __construct()
    	{
    		$this->cleUser = new CleUser();
			$this->cleUserList = new ArrayList();
    	}
    }
    
?>