$(function(){
  $('.login-form').submit(function(){
    $check = 0
    $('.form-control').removeClass('is-invalid')
    if($('#txtEmail').val() == ''){
      $('#txtEmail').addClass('is-invalid')
      $check++
    }
    if($('#txtPassword').val() == ''){
      $('#txtPassword').addClass('is-invalid')
      $check++
    }

    if($check != 0){
      return ;
    }

    var param = {
      email: $('#txtEmail').val(), password: $('#txtPassword').val()
    }

    preload.show()

    var jxr = $.post(conf.api + 'authen?stage=login', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if((snap != '') && (snap.length > 0)){
                   snap.forEach(i=>{
                     window.localStorage.setItem(conf.prefix + 'uid', i.UID)
                     window.localStorage.setItem(conf.prefix + 'role', i.role)
                     window.location = '../' + i.role + '/index'
                   })
                 }else{
                   preload.hide()
                   swal("Error!", "Authentication fail", "error")
                 }
               })
  })
})
