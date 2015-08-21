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

    # ------------------------
    # function Controller
    # Behaviour : default constructor
    # Input : none
    # Output: none
    # ------------------------
    public function Controller() {
        $this->template = Configuration::getConfiguration("defaultTemplate");
    }

    # ------------------------
    # function renderTemplate
    # Behaviour : Trigger the render of template
    # Input : array : data used in
    # Output: none
    # ------------------------
    protected function renderTemplate($data = array()) {
        include($this->template);
    }
}
