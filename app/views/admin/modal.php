<div  id="updateModal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit User (id: <span id="idSpan"></span>): 
          <span id="usernameSpan"></span>
          
      </h5>
        <button id="modalCloseIcon" type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
              <label for="username">Username</label>
              <input type="text" name="username" id="usernameField">
          </div>

          <div class="form-group">
              <label for="email">Email</label>
              <input type="text" name="email" id="emailField">
          </div>

          <div class="form-group">
              <label for="role">Role</label>
              <select name="cars" id="roleField">
                <option value="1">Admin</option>
                <option value="0">User</option>
              </select>
          </div>

        </form>
        <p style="display: none;" id="errorLabel" class="text-danger">dwada</p>


      </div>
      <div class="modal-footer">
        <button id="modalSaveButton" type="button" class="btn btn-primary">Save changes</button>
        <button id="modalCloseButton" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>