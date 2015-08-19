<?php

# -----------------------
# File : configuration.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# -----------------------

class Configuration {

	private static $_conf = array(
		"viewFolder" => "../views/",
		"defaultTemplate" => "../views/layout/template.php",

		"db_adress" 	=> "localhost",
		"db_port" 		=> "3306",
		"db_name" 		=> "apply_gladys",
		"db_user" 		=> "root",
		"db_password" 	=> "root",
	);

	# ------------------------
	# function getConfiguration
	# Behaviour : return configuration
	# Input : $var is the name of the needed information
	# Output: mixed (depend on what is stored)
	# ------------------------
	public static function getConfiguration($var) {
		return self::$_conf[$var];
	}
}