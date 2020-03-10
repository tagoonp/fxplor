$(function(){
  $('.register-form').submit(function(){
    $check = 0
    $('.form-control').removeClass('is-invalid')
    if($('#txtFname').val() == ''){
      $('#txtFname').addClass('is-invalid')
      $check++
    }
    if($('#txtLname').val() == ''){
      $('#txtLname').addClass('is-invalid')
      $check++
    }
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
      fname: $('#txtFname').val(), lname: $('#txtLname').val(), email: $('#txtEmail').val(), password: $('#txtPassword').val()
    }

    preload.show()

    var jxr = $.post(conf.api + 'authen?stage=register', param, function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if((snap != '') && (snap.length > 0)){
                   snap.forEach(i=>{
                     if(i.status = 'Success'){
                       window.localStorage.setItem(conf.prefix + 'uid', i.uid)
                       window.localStorage.setItem(conf.prefix + 'role', i.role)
                       window.location = '../' + i.role + '/index'
                     }else{
                       preload.hide()
                       swal("Error!", "Registration fail", "error")
                     }
                   })
                 }else{
                   preload.hide()
                   swal("Error!", "Registration fail", "error")
                 }
               })
  })
})
