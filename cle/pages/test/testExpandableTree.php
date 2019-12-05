<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="../../expandableTree/mktree.js"></script>
<link rel="stylesheet" type="text/css" href="../../expandableTree/mktree.css" media="screen">
<SCRIPT LANGUAGE="JavaScript">
	// var treeClass = "myTreeClass";  // instead of mktree
	// var nodeClosedClass = "closed"; // instead of liClosed
	// var nodeOpenClass = "open";     // instead of liOpen
	// var nodeBulletClass = "bullet"; // instead of liBullet
	// var nodeLinkClass = "link";     // instead of bullet
</SCRIPT>
  
</head>
<body>


<ul class="mktree" id="tree" >
  <li> <a>Los Angeles</a>
    <ul>
      <li> <a>Commercial Properties</a>
        <ul>
          <li id="node1"> <a href="#">Office</a> </li>
          <li> <a>Industrial</a> </li>
          <li> <a>Retail</a> </li>
        </ul>
      </li>
    </ul>
  </li>
</ul>

<input name="" type="button" value="Expand to Item" onclick="expandToItem('tree', 'node1');" />
<input name="" type="button" value="Expand All" onclick="expandTree('tree');" />
<input name="" type="button" value="Collapse Tree" onclick="collapseTree('tree'); " />
</body>
</html>