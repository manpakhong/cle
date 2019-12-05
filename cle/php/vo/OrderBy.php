<?php
	class OrderBy
	{
		private $field;
		private $isAsc;

		public function setField($value)
		{
			$this->field = $value;
		}
		public function getField()
		{
			return $this->field;
		}
		public function setIsAsc($value)
		{
			$this->isAsc = $value;
		}
		public function getIsAsc()
		{
			return $this->isAsc;
		}
		
	}

?>