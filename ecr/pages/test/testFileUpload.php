<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>File Upload Test</title>
</head>

<body>
    <form enctype="multipart/form-data" action="../../php/cmd/FileUploadCmd.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
        	Choose a file to upload: <input name="uploadedfile" type="file" /><br />
        <input name="CMD" type="hidden" value="FLEX_FILE_UPLOAD" />
        <input type="submit" value="Upload File" />
    </form>
</body>
</html>