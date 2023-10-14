$(document).ready(function(){
  const body = $('body, html');
  const loadingScreen = $('.loading_screen');

  $('[data-toggle="tooltip"]').tooltip();  
  $('select').select2();

  CKEDITOR.replace( 'editor1', {
    skin: 'moono-dark',
    filebrowserBrowseUrl: '../../ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: '../../ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: '../../ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: '../../ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
  } );

  window.editUserSignature = CKEDITOR.instances['editor1'];
  window.editUserAvatarImg = $('.editUserAvatarImg');

  window.showLoading = function() {
    loadingScreen.css('display', 'flex');
    body.css('overflow-x', 'hidden');
    body.css('overflow-y', 'hidden');
  }

  window.hideLoading = function() {
    loadingScreen.css('display', 'none');
    body.css('overflow-x', 'unset');
    body.css('overflow-y', 'unset');
  }

  window.toastifyError = {
    text: "This is a toast",
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true, 
    style: {
      fontWeight: 'lighter',
      background: "linear-gradient(to right, rgb(177 35 46), rgb(234 107 107))",
    },
    onClick: function(){}
  };

  window.toastifyWarning = {
    text: "This is a toast",
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true, 
    style: {
      fontWeight: 'lighter',
      background: "linear-gradient(90deg, hsla(33, 100%, 53%, 1) 0%, hsla(58, 100%, 68%, 1) 100%);",
    },
    onClick: function(){}
  };

  window.toastifySuccess = {
    text: "This is a toast",
    duration: 3000,
    close: true,
    gravity: "top",
    position: "right",
    stopOnFocus: true, 
    style: {
      fontWeight: 'lighter',
      background: "linear-gradient(to right, #00b09b, #96c93d)",
    },
    onClick: function(){}
  };
});
