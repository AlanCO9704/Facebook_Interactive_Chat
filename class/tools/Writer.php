<?php
namespace tools;
class Writer
{
	private $name;
	private $title;
	private $time;
	private $content;
	public function __construct()
	{
		date_default_timezone_set("Asia/Jakarta");
	}
	public function __new($name=null,$title=null)
	{
		$this->name = $name;
		$this->title = $title;
		$this->time = time();
		$this->content = array(
				"author"=>$name,
				"title"=>$title,
				"date"=>(date("Y-m-d H:i:s",$this->time)),
				"content"=>array()
		);
	}
	public function write($name=null,$msg=null)
	{
		$this->content['content'][] = array(
					"name"=>$name,
					"msg"=>$msg,
					"time"=>time()
		);
	}
	public function open($file)
	{
		$this->content = json_decode(file_get_contents($file),true);
		return $this->content!==null?true:false;
	}
	public function save($file)
	{
		return (bool)file_put_contents($file,json_encode($this->content));
	}
}