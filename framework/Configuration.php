<?php

class Configuration
{

	private static $parameters;

	//Renvoi la valeur d'un paramètre de configuration
	public static function get($name, $defaultValue = null)
	{
		if (isset(self::getParameters() [$name]))
		{
			$value = self::getParameters() [$name];
		}
		else
		{
			$value = $defaultValue;
		}
		return $value;
	}

	//Renvoi le tableau des paramètres en le chargeant au besoin
	private static function getParameters()
	{
		if (self::$parameters == null)
		{
			$file = "config/prod.ini";
			if (!file_exists($file))
			{
				$file = "config/dev.ini";
			}
			if (!file_exists($file))
			{
				throw new Exception("Aucun fichier de configuration trouvé.");				
			}
			else
			{
				self::$parameters = parse_ini_file($file);
			}
		}
		return self::$parameters;
	}
}