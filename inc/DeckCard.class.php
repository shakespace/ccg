<?php

class DeckCard
{
	public $order;
	public $card_id;
	public $artifact_id;
	
	function DeckCard($card_id, $order)
	{
		$this->card_id = $card_id;
		$this->order = $order;
	}
	
	/*
	public function get_card_id()
	{
		return $this->card_id;
	}
	
	public function get_order()
	{
		return $this->order;
	}
	
	public function set_order($order)
	{
		$this->order = $order;
	}
	
	public function set_artifact_id($artifact_id)
	{
		$this->artifact_id = $artifact_id;
	}
	
	public function get_artifact_id()
	{
		return $this->artifact_id;
	}
	*/
}

//在非战斗状态
//内存中只需要保留card_id和artifact_id

//在战斗状态
//需要创建card对象（当这张牌被打出时）
//首先根据card_id从全局数组中复制出card_base
//然后根据artifact_id更新card中的max_hp等（不是card_base的max_hp）
//再根据artifact_id更新card中的skill等
//这个card对象将跟随battle对象保存在cache中直到battle结束。

?>