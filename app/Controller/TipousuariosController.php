<?php
class TipousuariosController extends AppController {

	var $name = 'Tipousuarios';

	function index() {
		$this->Tipousuario->recursive = 0;
		$this->set('tipousuarios', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Incorrecto tipousuario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipousuario', $this->Tipousuario->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tipousuario->create();
			if ($this->Tipousuario->save($this->data)) {
				$this->Session->setFlash(__('El tipousuario ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipousuario no pudo ser guardado. Por gavor, intente de nuevo.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalido tipousuario', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tipousuario->save($this->data)) {
				$this->Session->setFlash(__('El tipousuario ha sido guardado', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('El tipousuario no pudo ser guardado. Pro favor, intente de nuevo.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tipousuario->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Identificador invalido tipousuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tipousuario->delete($id)) {
			$this->Session->setFlash(__('Tipousuario borrado', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Tipousuario no se pudo borrar', true));
		$this->redirect(array('action' => 'index'));
	}
}
