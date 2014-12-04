<?php
//Prints a red error box with all error messages when a form fails to validate
if(isset($failure_messages)) { ?>
    <div class="panel panel-default error"><div class="panel-body">
<?php foreach($failure_messages as $error) {
           echo "<p>".$error."<p>";
}
?>
    </div></div>
<?php } ?>