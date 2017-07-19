<?php require(PROTECT);
	
	class Controller {
		public function controller() {
			$this->view = new view();
		}

		public function model($model_name) {
			return Model::load($model_name);
		}
	}