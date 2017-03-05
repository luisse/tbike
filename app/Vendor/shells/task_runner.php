<?php
class TaskRunnerShell extends Shell {
   var $tasks = array('AclControllers');
   function main() {
      $this->print_instructions();
   }
   function print_instructions() {
      $this->out("\nCommands");
      $this->hr();
      foreach($this->tasks AS $t) {
         $description = isset($this->{$t}->description) ? $this->{$t}->description : '';
         $this->out($this->shell . ' ' . Inflector::underscore($t) . "\t$description\n");
      }
   }
}
?>
