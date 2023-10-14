<div class="modal fade" id="modalEditUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editUserTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-12 text-center d-flex align-items-center justify-content-center">
            <input type="file" id="avatarUploadField" style="display:none"/> 
            <div class="wrap-image-avatar">
              <img class="editUserAvatarImg" src="https://placehold.co/100x100" width="100px" height="100px" />
              <div class="uploadAvatarUser">
                <span class="mdi mdi-camera"></span>
              </div>
            </div>
          </div>
        </div>
        <fieldset class="border p-2">
          <legend class="w-auto">User Profile Information</legend>
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="forms-sample">
                  <div class="row">
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="editUserUsername">Username</label>
                        <input type="text" class="form-control" id="editUserUsername" placeholder="Username" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="editUserEmail">Email address</label>
                        <input type="email" class="form-control" id="editUserEmail" placeholder="Email" required>
                      </div>
                    </div>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label for="editUserPassword">Password</label>
                        <input type="password" class="form-control" id="editUserPassword" placeholder="Password" required>
                      </div>
                    </div>
                  </div>
                  <div class="row editUserRole">
                    <div class="col-md-12 grid-margin">
                      <label for="editUserAboutMe mb-2">Role</label>
                      <div class="row">
                      @foreach ($roles as $role)
                        @if ($role->name !== 'super-admin')
                        <div class="col-md-4">
                          <div class="form-check form-check-success">
                            <label class="form-check-label edit-user-role-label">
                              <input type="checkbox" class="form-check-input role-user-checkbox role-user-{{ $role->name }}" name="role[]" value="{{ $role->name }}"> {{ $role->name }}
                            </label>
                          </div>
                        </div>
                        @endif
                      @endforeach
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="editUserAboutMe">About Me</label>
                        <textarea type="text" class="form-control" id="editUserAboutMe" placeholder="About Me"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="editor1">Signature</label>
                        <textarea class="form-control editUserSignature" id="editor1" placeholder="Signature"></textarea>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
       </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary submitUpdate">Update</button>
      </div>
    </div>
  </div>
</div>
