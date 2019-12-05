<?php
	class ResourceTypeNode extends ResourceType
	{
		private $isMatch;
		
		public function getIsMatch()
		{
			return $this->isMatch;
		}
		public function setIsMatch($value)
		{
			$this->isMatch = $value;
		}
	}
?>