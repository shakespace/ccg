<?php

class Skill
{
	public $id;
	
	//类型：
	//主动技active
	//被动技passive
	//攻击技attack
	//防御技defense
	public $type;
	
	//名称，描述
	public $name;
	public $desc;
	
	//图标，动画
	public $icon;
	public $anim;
	
	function Skill($id, $type, $name, $desc = NULL, $icon = NULL, $anim = NULL)
	{
		$this->id = $id;
		$this->type = $type;
		$this->name = $name;
		$this->desc = $desc;
		$this->icon = $icon;
		$this->anim = $anim;
	}
	
	/*
	public function setId($id)
	{
		$this->id = $id;
	}
	
	public function getId()
	{
		return $this->id;
	}
	
	public function getType()
	{
		return $this->type;
	}
	
	public function setType($type)
	{
		$this->type = $type;
	}
	
	public function getName()
	{
		return $this->name;
	}
	
	public function setName($name)
	{
		$this-name = $name;
	}
	
	public function getDesc()
	{
		return $this->desc;
	}
	
	public function setDesc($desc)
	{
		$this->desc = $desc;
	}
	*/
}

?>