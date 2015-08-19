<?php

# ---------------------------------
# File : controller.php
# Creator : Jeremy Lardet
# Date : 20/08/2015
# ---------------------------------
class Controller {
	protected $viewFolder;

	protected $view;
	protected $template;

	public function Controller() {
		$this->template = Configuration::getConfiguration("defaultTemplate");
	}

	protected function renderTemplate($data = array()) {
		include($this->template);
	}
}

?>