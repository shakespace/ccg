<?php

require_once('inc/Lite.php');

class CacheManager
{
	/**
	* 
	* Return: @void
	*/
	public static function setValue($key, $group = null, $value, $duration)
	{
		$cacheOption = array(
			'cacheDir' => 'tmp/',
			'lifeTime' => $duration
		);
		
		$cache = new Cache_Lite($cacheOption);
		$flag = $cache->save($value, $key, $group);
	}
	
	/**
	*
	* Return: data of the cache (or false if no cache available)
	*/
	public static function getValue($key, $group = null)
	{
		$cacheOption = array(
			'cacheDir' => 'tmp/'
		);
		
		$cache = new Cache_Lite($cacheOption);
		
		return $cache->get($key, $group);
	}

}	

?>