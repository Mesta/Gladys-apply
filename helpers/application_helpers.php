<?php
# -----------------------
# File : application_helpers.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# -----------------------

# ---------------
# function params
# Behaviour : check if parameters exist and return them
# Input : none
# Output: POST or GET header
# ---------------
function params(){
	if (isset($_SERVER['REQUEST_METHOD']))
	{
		switch ($_SERVER['REQUEST_METHOD'])
		{
			case 'GET':
			return $_GET;
			break;

			case 'POST':			
			return $_POST;
			break;

			case 'DELETE':
			return $_GET;
			break;
		}
	}

}

# ---------------
# function pre
# Behaviour : devel stuff to display array content
# Input : php array
# Output: display array in <pre>
# ---------------
function pre($array){
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}

# ---------------
# function joinPath
# Behaviour : create a well formed path
# Input : php array
# Output: string
# ---------------
function joinPath($folders){
	return join("/", $folders);
}

?>