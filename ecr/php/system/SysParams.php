<?php

	class SystemParam
	{
		public static $CMD = 'CMD';
		public static $CMD_FLEX_SELECT_ALL = 'FLEX_SELECT_ALL';
		public static $CMD_FLEX_SELECT = 'FLEX_SELECT';
		public static $CMD_FLEX_INSERT = 'FLEX_INSERT';
		public static $CMD_FLEX_UPDATE = 'FLEX_UPDATE';
		public static $CMD_FLEX_DELETE = 'FLEX_DELETE';
		public static $CMD_FLEX_FILE_UPLOAD = 'FLEX_FILE_UPLOAD';
		public static $CMD_FLEX_FILE_DOWNLOAD = 'FLEX_FILE_DOWNLOAD';
		public static $CMD_FILE_UPLOAD = 'FILE_UPLOAD';
		public static $CMD_FILE_DOWNLOAD = 'FILE_DOWNLOAD';
		
		
		public static $CMD_SELECT_ALL = 'SELECT_ALL';
		public static $CMD_SELECT = 'SELECT';
		public static $CMD_INSERT = 'INSERT';
		public static $CMD_UPDATE = 'UPDATE';
		public static $CMD_DELETE = 'DELETE';		
		
		public static $FORM_ACTION = 'FORM_ACTION';
		public static $FORM_ACTION_POST = 'POST';
		public static $FORM_ACTION_PUT = 'PUT';
		public static $FORM_ACTION_GET = 'GET';
		public static $FORM_ACTION_DELETE = 'DELETE';
				
		public static $SYSTEM_VALUES_TYPE = 'SYSTEM_VALUES_TYPE';
		public static $SYSTEM_VALUES_TYPE_COOKIE = 'SYSTEM_VALUES_TYPE_COOKIE';
		public static $SYSTEM_VALUES_TYPE_SESSION = 'SYSTEM_VALUES_TYPE_SESSION';
		
		public static $SYSTEM_LANGUAGE = 'SYSTEM_LANGUAGE';
		public static $SYSTEM_LANGUAGE_TC = 'SYSTEM_LANGUAGE_TC';
		public static $SYSTEM_LANGUAGE_EN = 'SYSTEM_LANGUAGE_EN';
		
		public static $RETURN_URL = 'returnUrl';
		
		public static $SYSTEM_LOGOUT = 'logoff';
		
		public static $LOG = 'LOG';
		public static $LOG_TYPE_MESSAGE_VO = 'LOG_TYPE_MESSAGE_VO';
		public static $LOG_TYPE_MESSAGE_SQL = 'LOG_TYPE_MESSAGE_SQL';
		public static $LOG_TYPE_MESSAGE_RESULT = 'LOG_TYPE_MESSAGE_RESULT';			
		public static $LOG_TYPE_ECR_ERROR = 'LOG_TYPE_ECR_ERROR';
		public static $LOG_TYPE_ECR_WARNING = 'LOG_TYPE_ECR_WARNING';
		public static $LOG_TYPE_SYSTEM_EXCEPTION = 'LOG_TYPE_SYSTEM_EXCEPTION';
		
		/*
		public static $LOG_SEVERE = 'SEVERE';
		public static $LOG_WARNING = 'WARNING';
		public static $LOG_INFO = 'INFO';
		public static $LOG_CONFIG = 'CONFIG';
		public static $LOG_FINE = 'FINE';
		public static $LOG_FINER = 'FINER';
		public static $LOG_FINEST = 'FINEST';		
		*/
		
		public static $ECR_USER = 'ECR_USER';	

		public static $ERROR_MSG_FILE = 'php/error/exceptionCode.txt';
		public static $LOG_FILE = 'php/log/log.txt';

		public static $SYSTEM_RELATIVE_DOC_ROOT = 'SYSTEM_RELATIVE_DOC_ROOT';
		public static $SYSTEM_RELATIVE_DOC_ROOT_LOCAL = '/ecr';
		public static $SYSTEM_RELATIVE_DOC_ROOT_REMOTE = '/ecopyright/ecr';
		
		public static $LOGIN_MESSAGE_SUCCESS = 'SUCCESS';
		public static $LOGIN_MESSAGE_FAILED = 'FAILED';
		
		public static $RESOURCE_TYPE_SID = 'typeSid';
		
		public static $SYSTEM_PAGE_LOCATIONS = 'SYSTEM_PAGE_LOCATIONS';
		public static $SYSTEM_PAGE_LOCATION_ROOT = 'ROOT';
		public static $SYSTEM_PAGE_LOCATION_PAGES = 'PAGES';
		public static $SYSTEM_PAGE_LOCATION_SYSTEM = 'SYSTEM';
		
		// Server-side Target File Upload Folder - if using flex-bin as measure
		public static $UPLOAD_FILE_FOLDER = 'data';
	}

?>