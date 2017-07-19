<?php require(PROTECT);
	class Home extends Controller {
		function home() {
			parent::controller();
			$this->header_vars = new stdClass();
		}

		function index() {
			$this->header_vars->title = 'ForkMVC';
			$this->view->load('header', $this->header_vars);
			$this->view->load('home');
			$this->view->load('footer');
		}
	}
