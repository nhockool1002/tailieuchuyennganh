$(document).ready(function() {
  const btnEditUser = $('.btnEditUser');
  const modalEditUser = $('#modalEditUser');
  const modalEditUserTitle = $('#editUserTitle');
  const editUserUsername = $('#editUserUsername');
  const editUserEmail = $('#editUserEmail');
  const editUserPassword = $('#editUserPassword');
  const editUserAboutMe = $('#editUserAboutMe');
  const editUserRole = $('.editUserRole');
  const uploadAvatarUser = $('.uploadAvatarUser');
  const uploadAvatarField = $('#avatarUploadField');
  const submitUpdate = $('.submitUpdate');
  let table = new DataTable('#userTable'); 
  let globalCurrentUser = null;

  uploadAvatarUser.click(function() {
    uploadAvatarField.trigger('click');
  });

  uploadAvatarField.change(function() {
    var file = this.files[0];

    if (!file) {
      file = null;
      Toastify({
        ...toastifyWarning,
        text: `[CHANGE AVATAR]: No file selected.`
      }).showToast();
      return;
    }

    const allowedTypes = ['image/png', 'image/jpeg', 'image/gif'];
    if (!allowedTypes.includes(file.type)) {
      Toastify({
        ...toastifyError,
        text: `[CHANGE AVATAR]: Invalid file type. Please select an image (png, jpg, jpeg, gif).`
      }).showToast();
      file = null;
      return;
    }

    const maxSize = 1048576;
    if (file.size > maxSize) {
      Toastify({
        ...toastifyError,
        text: `[CHANGE AVATAR]: File size exceeds the maximum limit of 1MB.`
      }).showToast();
      file = null;
      return;
    }

    showLoading();
    uploadAvatarUser.css('display', 'none');
    const formData = new FormData();
    formData.append('file', file);


    axios.post(`user/avatar/${globalCurrentUser}`, formData, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(response => {
      hideLoading();
      uploadAvatarUser.css('display', 'flex');
      Toastify({
        ...toastifySuccess,
        text: `[GET USER]: ${response.data?.success}`
      }).showToast();
      editUserAvatarImg.attr('src', `/upload/users/images/${response.data?.file_name}`)
    })
    .catch(error => {
      hideLoading();
      uploadAvatarUser.css('display', 'flex');
      Toastify({
        ...toastifyError,
        text: `[GET USER]: ${error.data?.error}`
      }).showToast();
    });
  });

  btnEditUser.click(function() {
    var currentUser = $(this).data('id');
    globalCurrentUser = $(this).data('id');
    showLoading();
    axios.get(`user/${currentUser}`)
    .then(response => {
        var data = response?.data?.user;
        var roles = data?.roles;
        var is_super_admin = response?.data?.is_super_admin;
        modalEditUserTitle.text(`Edit user [${data?.username}]`);
        editUserUsername.val(data?.username);
        editUserEmail.val(data?.email);
        editUserAboutMe.val(data?.aboutme);
        editUserSignature.setData(data?.sign);
        editUserRole.css('display', is_super_admin ? 'none' : 'block'); 
        $('.edit-user-role-label input').prop('checked', false);
        !is_super_admin && roles && roles.length > 0 && roles.map(function(item) {
          $(`.role-user-${item.name}`).prop('checked', true);
        });
        data.avatar 
          ? editUserAvatarImg.attr('src', `/upload/users/images/${data.avatar}`)
          : editUserAvatarImg.attr('src', 'https://placehold.co/100x100');
        hideLoading();
        modalEditUser.modal();
        return;
    })
    .catch(error => {
        console.log(error);
        hideLoading();
        Toastify({
          ...toastifyError,
          text: `[GET USER]: ${error?.response?.data?.message}`
        }).showToast();
    });
  });

  submitUpdate.click(function() {
    const editUserUsername = $('#editUserUsername');
    const editUserEmail = $('#editUserEmail');
    const editUserPassword = $('#editUserPassword');
    const editUserAboutMe = $('#editUserAboutMe');
    const editUserSignature = $('.editUserSignature');
    const rolesSelection = $('.role-user-checkbox:checked');
    const rolesSelected = [];
    rolesSelection.each(function() {
      rolesSelected.push($(this).val());
    });
    showLoading();
    axios.post(`user/${globalCurrentUser}`, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(function(res) {
      hideLoading();
      console.log(res);
    })
    .catch(function(error) {
      hideLoading();
      console.log(error);
    })
  });
});
