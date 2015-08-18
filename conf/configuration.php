<?php

# -----------------------
# File : configuration.php
# Creator : Jeremy Lardet
# Date : 18/08/2015
# -----------------------

class Configuration {
	private $_conf;

	public function Configuration() {
		$_conf = array();
	}

	public function getConfiguration() {
		return this.$_conf;
	}
}