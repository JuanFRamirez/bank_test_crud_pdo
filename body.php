<?php
include_once 'header.php';
include_once 'connection.php';

?>
<div class="col-sm-7 main-login">


    <label>Name:</label><br>
    <input type="text" class="name" id="name" autocomplete="off"><br>
    <label>Password:</label><br>
    <input type="password" class="password" id="password" autocomplete="off"><br>
    <button class="btn btn-info login" id="login" style="margin-top:5px">Check Balance</button>

</div>


<div class="ammountHolder">

</div>



<!--Modal-->

<div class="modal" id="new-customer" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create Account</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label>Name:</label><br>
        <input type="text" name="userName" id="userName" class="form-control"></input><br>
        <label>Password:</label><br>
        <input type="password" name="userPassword" id="userPaswword" class="form-control"></input>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary save-user">Save User</button>
      </div>
    </div>
  </div>
</div>
<!---->
<?php
include_once 'footer.php';
?>