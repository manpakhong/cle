<?php
class WebRef {

	protected $sid;
	protected $website;
	protected $type;
	protected $learninghighlight;
	protected $lastupdate;
	protected $remarks;
	
	public function getSid()
	{
		return $this->sid;
	}
	
	public function setSid($value)
	{
		$this->sid = $value;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($value)
	{
		$this->type = $value;
	}	
	
	public function getWebSite()
	{
		return $this->website;
	}
	
	public function setWebSite($value)
	{
		$this->website = $value;
	}
	
	public function getLearningHighlight()
	{
		return stripslashes($this->learninghighlight);
	}

	public function setLearningHighlight($value)
	{
		$this->learninghighlight = $value;
	}
	
	public function getLastUpdate()
	{
		return $this->lastupdate;
	}
	
	public function setLastUpdate($value)
	{
		$this->lastupdate = $value;
	}
	
	public function getRemarks()
	{
		return $this->remarks;
	}
	
	public function setRemarks($value)
	{
		$this->remarks = $value;
	}
	
	protected function outputVarsList() {
		$arrayList = new ArrayList();
		
		$arrayoutput = array();
	
		foreach($this as $var => $value) {
			// echo "$var is $value\n";
			$arrayoutput[$var] = $value;
		}
				
		return $arrayoutput;
	}
	
} 

?>