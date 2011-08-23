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
			'lifeTime' => $duration,
			'automaticSerialization' => true
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
			'cacheDir' => 'tmp/',
			'automaticSerialization' => true
		);
		
		$cache = new Cache_Lite($cacheOption);
		
		return $cache->get($key, $group);
	}

	/**
	*
	* Clear Cache
	*/
	public static function clearCache()
	{
		$cacheOption = array(
			'cacheDir' => 'tmp/'
		);
		
		$cache = new Cache_Lite($cacheOption);
		
		return $cache->clean();
	}

}	

?>