<?php

class OrderBehavior extends ModelBehavior {
	
	function setOrder(&$model, $id = null, $order = null) { 
		if ($id) {

			if (empty($id)) {
				return ;
			}

			$model->data = $model->find('first', array('conditions' => array($model->alias.'.id'=>$id),));
			$model->data[$model->alias]['sort_order'] = $order;
		}
		return $model->save($model->data);	
	}
}