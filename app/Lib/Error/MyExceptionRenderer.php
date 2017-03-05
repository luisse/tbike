<?php
App::uses('ExceptionRenderer', 'Error');

class MyExceptionRenderer extends ExceptionRenderer {
  protected function _outputMessage($template) {
    $this->controller->layout = 'errorview';
    $this->controller->set('title_for_layout','Error');
    parent::_outputMessage($template);
  }
}

?>
