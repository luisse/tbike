<?php 
App::uses('ExceptionRenderer', 'Error');

class AppExceptionRenderer extends ExceptionRenderer {
  protected function _outputMessage($template) {
    $this->controller->layout = 'errorview';
    $this->controller->set('title_for_layout','Error');
    parent::_outputMessage($template);
  }
}

?>