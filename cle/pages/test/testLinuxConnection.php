<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
		echo 'server document root: ' . $_SERVER['DOCUMENT_ROOT'] . '<br/>';
		echo 'dirname: ' . dirname(__FILE__) . '<br/>';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/Connection.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/LoginSession.php';	
        require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/dao/UserDao.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/vo/User.php';
		require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/vo/UserFilter.php';	
		require_once $_SERVER['DOCUMENT_ROOT'] . '/cle/php/common/ArrayList.php';					
?>
</head>

	
<body>
    <div id="login">
        <ul>
            <li><?php echo $authenticatedUser->getName(); ?></li>
            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '|' : '');  ?></li>
            <li><?php echo (strlen($authenticatedUser->getUserId()) == 0 ? '<a href="'. ($_SERVER['PHP_SELF'] == '/cle/landingPage.php' ? 'pages/userLogin.php' : 'userLogin.php') .'">管理登入</a>': '<a href="#" onclick="logout(\''. $_SERVER['PHP_SELF'] .'\')">登出</a>') ?></li>
            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '|' :''); ?></li>
            <li><?php echo (strlen($authenticatedUser->getUserId()) > 0 ? '<a href="' . ($_SERVER['PHP_SELF'] == '/cle/landingPage.php' ? 'pages/adminControlPanel.php' : 'adminControlPanel.php') . '">管理面版</a>' : '') ?></li>                     
        </ul>
    </div>
	<?php
		try
		{
			$userList = new ArrayList();
			$userFilter = new UserFilter();
			$userDao = new UserDao();
			
			$userList = $userDao->selectUser($userFilter);
			
			while ($userList->hasNext())
			{
				$user = new User();
				$user = $userList->next();
				
				echo $user->getSid() . '<br/>';
				
			}
			
			echo 'hello world';
		}
		catch (Exception $e)
		{
			echo 'Exception: ' . $e;
		}
	?>
</body>
</html>