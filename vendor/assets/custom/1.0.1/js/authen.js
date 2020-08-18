var authen = {
  login(){
    preload.show()
    var param = {username: $('#txtEmail').val(), password: $('#txtPassword').val()}
    var jxr = $.post(conf.api + 'authen?stage=login', param, function(){}, 'json')
               .always(function(snap){
                 if(snap.status == 'Success'){
                   window.localStorage.setItem(conf.prefix + '_uid', snap.uid)
                   window.localStorage.setItem(conf.prefix + '_role', snap.role)
                   if(snap.role == 'common'){
                     window.location = './?uid=' + snap.uid
                   }else{
                     window.location = './' + snap.role + '/?uid=' + snap.uid
                   }
                 }else{
                   $('#reqEmail').removeClass('dn')
                   $('#reqEmail').text('** Invalid e-mail or password')
                   preload.hide()
                 }
               })
  }
}

$(function(){

  $('.registerform_th').submit(function(){
    $check = 0
    $('.reqDiv').addClass('dn')
    $('.form-control').removeClass('is-invalid')
    $('#reqEmail').text('** กรุณาระบุอีเมลแอดเดรส')

    if($('#txtPid').val() == ''){
      $('#txtPid').addClass('is-invalid'); $check++;
      $('#reqPid').removeClass('dn')
    }

    if($('#txtFname').val() == ''){
      $('#txtFname').addClass('is-invalid'); $check++;
      $('#reqFname').removeClass('dn')
    }

    if($('#txtLname').val() == ''){
      $('#txtLname').addClass('is-invalid'); $check++;
      $('#reqLname').removeClass('dn')
    }

    if($('#txtDept').val() == ''){
      $('#txtDept').addClass('is-invalid'); $check++;
      $('#reqDept').removeClass('dn')
    }

    if($('#txtPtype').val() == ''){
      $('#txtPtype').addClass('is-invalid'); $check++;
      $('#reqPtype').removeClass('dn')
    }

    if($('#txtPhone').val() == ''){
      $('#txtPhone').addClass('is-invalid'); $check++;
      $('#reqPhone').removeClass('dn')
    }

    if($('#txtEmail').val() == ''){
      $('#txtEmail').addClass('is-invalid'); $check++;
      $('#reqEmail').removeClass('dn')
    }

    if($('#txtPassword').val() == ''){
      $('#txtPassword').addClass('is-invalid'); $check++;
      $('#reqPassword').removeClass('dn')
    }
    if($check != 0){ return ;}

    var param = {
      pid: $('#txtPid').val(),
      fname: $('#txtFname').val(),
      lname: $('#txtLname').val(),
      prefix: $('#txtPrefix').val(),
      phone: $('#txtPhone').val(),
      dept: $('#txtDept').val(),
      ptype: $('#txtPtype').val(),
      email: $('#txtEmail').val(),
      password: $('#txtPassword').val()
    }

    preload.show()
    var jxr = $.post(conf.api + 'authentication?stage=register', param, function(){}, 'json')
               .always(function(snap){
                 if(snap.status == 'Success'){
                   window.localStorage.setItem(conf.prefix + 'uid', snap.uid)
                   window.localStorage.setItem(conf.prefix + 'role' 'common')
                   window.location = './common/?uid=' + snap.uid + '&role=common&lang=th'
                 }else if(snap.status == 'Duplicate'){
                   $('#reqEmail').removeClass('dn')
                   $('#reqEmail').text('** พบอีเมลนี้ถูกใช้ในระบบแล้ว')
                   preload.hide()
                 }else{
                   alert('ไม่สามารถสมัครใช้งานได้ กรุณาลองใหม่ภายหลังหรือติดต่อเจ้าหน้าที่')
                   preload.hide()
                 }
               })

  })


  $('.loginform_th').submit(function(){
    $check = 0
    $('.reqDiv').addClass('dn')
    $('.form-control').removeClass('is-invalid')
    $('#reqEmail').text('** กรุณากรอกอีเมลแอดเดรสของท่าน')
    if($('#txtEmail').val() == ''){
      $('#txtEmail').addClass('is-invalid'); $check++;
      $('#reqEmail').removeClass('dn')
    }
    if($('#txtPassword').val() == ''){
      $('#txtPassword').addClass('is-invalid'); $check++;
      $('#reqPassword').removeClass('dn')
    }
    if($check != 0){ return ;}

    authen.login()
  })

  $('.loginform').submit(function(){
    $check = 0
    $('.reqDiv').addClass('dn')
    $('.form-control').removeClass('is-invalid')
    $('#reqEmail').text('** Please enter e-mail address')
    if($('#txtEmail').val() == ''){
      $('#txtEmail').addClass('is-invalid'); $check++;
      $('#reqEmail').removeClass('dn')
    }
    if($('#txtPassword').val() == ''){
      $('#txtPassword').addClass('is-invalid'); $check++;
      $('#reqPassword').removeClass('dn')
    }
    if($check != 0){ return ;}

    authen.login()
  })

  $('.registerform').submit(function(){

    $check = 0
    $('.reqDiv').addClass('dn')
    $('.form-control').removeClass('is-invalid')
    $('#reqEmail').text('** Please enter e-mail address')
    if($('#txtName').val() == ''){
      $('#txtName').addClass('is-invalid'); $check++;
      $('#reqName').removeClass('dn')
    }
    if($('#txtEmail').val() == ''){
      $('#txtEmail').addClass('is-invalid'); $check++;
      $('#reqEmail').removeClass('dn')
    }
    if($('#txtPassword').val() == ''){
      $('#txtPassword').addClass('is-invalid'); $check++;
      $('#reqPassword').removeClass('dn')
    }

    if($check != 0){ return ;}

    authen.register()
  })
})
