<?php
class ArrayList {
	 
	//Copyright Mike Lang - icurtain.co.uk - please retain this header and give credit if used.
	//This is a little class I've written to make my life easier and a little more like Java
	//for those occasions when i just can't afford Java hosting
	//It doesnt work the same as a Java arrayList.. it's just a high level aproximation of it
	//if you have any comments or suggestions for improving or changing this class feel free to mail me
	//mike [at] bluemedia dot co dot uk
	 
	//ARRAY LIST CLASS STARTS COUNTING AT 0!!!!!
	private $arrayList = array();
	private $pointer = 0;
	private $sid = 0;

	
	public function getSid()
	{
		return $this->sid;
	}
	
	public function setSid($value)
	{
		$this->sid = $value;
	}
	
	public function version(){
		echo 'version 1.0';
	}

	public function goToTheBegin()
	{
		$this->pointer = 0;
	}
	
	public function add($item){
		//$this->arrayList[sizeof($this->arrayList)] = $item;
		array_push($this->arrayList, $item);
	}
	 
	public function addAtPos($position, $item){
		if($position < count($this->arrayList) && $position >= 0)
		{
			$this->add($item);
			$this->shift(count($this->arrayList)-1, $position);
		}
		else
		{
			throw new Exception('List out of bounds');
		}
	}
	 
	public function getList(){
		return $this->arrayList;
	}
	 
	public function hasValue(){
		if(isset($this->arrayList[$this->pointer]))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	 
	public function hasNext(){
		if($this->pointer <= count($this->arrayList)-1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	 
	 
	public function next(){
		// echo $this->pointer . '<br/>';
		if(isset($this->arrayList[$this->pointer]))
		{
			//return $this->arrayList[($this->pointer++)-1] = $value;
			$this->pointer++;
			return($this->arrayList[$this->pointer-1]);
		}
		else
		{
			$this->pointer++;
			return null;
		}
	}
	 
	public function shift($origin, $dest){
		//wont shift from last element
		if($origin > count($this->arrayList) || $origin < 0 || $dest > count($this->arrayList) || $dest < 0)
		{
			throw new Exception('List out of bounds');
		}
		if($origin > $dest)
		{
			$temp = $this->arrayList[$origin];
			$this->shiftUp($origin, $dest);
			$this->arrayList[$dest] = $temp;
		}
		else
		{
			$temp = $this->arrayList[$origin];
			$this->shiftDown($origin, $dest);
			$this->arrayList[$dest] = $temp;
		}
	}
	 
	private function shiftUp($origin, $dest)
	{
		for($i=$origin;$i>$dest;$i--)
		{
			$this->arrayList[$i] = $this->arrayList[$i-1];
		}
	}
	 
	private function shiftDown($origin, $dest)
	{
		for($i=$origin;$i<$dest;$i++)
		{
			$this->arrayList[$i] = $this->arrayList[$i+1];
		}
	}
	 
	public function remove($item){
		if(array_key_exists($item, $this->arrayList)){
			unset($this->arrayList[$item]);
		}
		else
		{
			throw new Exception('key not found');
		}
	}
	 
	public function addArray($array){
		foreach ($array as $item) {
			$this->add($item);
		}
	}

	public function reverse(){
		$this->arrayList = array_reverse($this->arrayList);
	}
	 
	public function size(){
		return count($this->arrayList);
	}
	 
	public function reset(){
		$this->pointer = 0;
	}
	 
	public function end(){
		$this->pointer = count($this->arrayList) -1;
	}
	
	public function getCurrentIndex()
	{
		return $this->pointer;
	}
	
	
}
?>