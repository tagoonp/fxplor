var files;

var project = {
  getDomain(){
    var jxr = $.post(conf.api + 'research_domain?stage=get', function(){}, 'json')
               .always(function(snap){
                 if(fnc.json_exist(snap)){
                   snap.forEach(i=>{
                     $('#txtCat').append('<option value="' + i.ID + '">' + i.knw_domain + '</option>')
                   })
                 }
               })
  },
  create(){
    $check = 0; $('.form-control').removeClass('dn')
    if($('#txtTitle').val() == ''){ $check++; $('#txtTitle').addClass('is-invalid') }
    if($('#txtCat').val() == ''){ $check++; $('#txtCat').addClass('is-invalid') }
    if($check != 0){ return ;}
    var param = {uid: current_user, title: $('#txtTitle').val(), desc: $('#txtDesc').val(), cat: $('#txtCat').val() }
    var jxr = $.post(conf.api + 'project?stage=create', param, function(){})
               .always(function(resp){
                 console.log(resp);
                 if(resp == 'Success'){
                   window.location = './project'
                 }else{
                   preload.hide()
                   swal("Fail!", "Can not create project", "error")
                 }
               })
  },
  delete(pid){
    swal({    title: "Are you sure?",
              text: "You will not be able to recover this imaginary file!",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#DD6B55",
              confirmButtonText: "Yes, delete it!",
              closeOnConfirm: true },
              function(){
                var param = {uid: current_user, pid: pid }
                var jxr = $.post(conf.api + 'project?stage=delete', param, function(){})
                           .always(function(resp){
                             if(resp == 'Success'){
                               project.get_list('get_list')
                             }else{
                               setTimeout(function(){
                                 preload.hide()
                                 swal("Fail!", "Can not delete project", "error")
                               })
                             }
                           })
              });
  },
  getInfo(){
    var param = {uid: current_user, pid: current_project }
    var jxr = $.post(conf.api + 'project?stage=get_info', param, function(){}, 'json')
               .always(function(snap){
                 if(fnc.json_exist(snap)){
                   snap.forEach(i=>{
                     $('#txtTitle').val(i.proj_title)
                     $('#txtDesc').val(i.proj_desc)
                     $('#txtCat').val(i.proj_category)
                   })
                 }else{
                   swal({
                      title: "Error",
                      text: "Invalid project ID or project not found",
                      type: "warning",
                      showCancelButton: false,
                      confirmButtonColor: "#DD6B55",
                      confirmButtonText: "Back to project list",
                      closeOnConfirm: true
                    },
                    function(){
                      window.location = './project'
                    });
                 }
               })
  },
  goto_manage(pid){
    window.localStorage.setItem(conf.prefix + 'project', pid)
    window.location = 'project-manage.php'
  },
  get_list(hl){
    preload.show()
    var param = {uid: current_user}
    var jxr = $.post(conf.api + 'project?stage=get_list', param, function(){},'json')
               .always(function(snap){
                 console.log(snap);
                 if(fnc.json_exist(snap)){
                   $('#textResult').html('<table class="table table-striped mb-0"><thead><tr style="background: rgb(71, 71, 71);"><th style="width: 50px; " class="text-white">#</th><th class="text-white">Title</th><th style="width: 150px !important;" class="text-white"></th></tr></thead><tbody id="resultList"></tbody></table>')
                   $c = 1;
                   snap.forEach(i=>{
                     $('#resultList').append('<tr><td style="vertical-align: top;" class="pt-2 pb-2">' + $c + '</td><td style="vertical-align: top;" class="pt-2 pb-2"><strong  onclick="project.goto_manage(\'' + i.PID + '\')" style="cursor: pointer;">' + i.proj_title + '</strong><div><small>' + i.proj_desc + '</small></div><div><small>Category : <span class="text-primary">' + i.knw_domain + '</span></small></div></td><td class="text-right pt-2 pb-2" style="vertical-align: top;">' +
                                                '<button class="btn btn-small bsdn" onclick="project.goto_manage(\'' + i.PID + '\')"><i class="fas fa-wrench"></i></button>' +
                                                '<button class="btn btn-small bsdn" onclick="project.delete(\'' + i.PID + '\')"><i class="fas fa-trash"></i></button>' +
                                            '</td></tr>')
                     $c++;
                   })
                 }else{
                   $('#textResult').html('<div class="p-3">No project found.<p class="mb-0"><a href="./project-create"><i class="fas fa-plus"></i> Click here to create your first project</a></p></div>')
                 }
                 if(hl == 'get_list'){ preload.hide() }
               })
  }
}


function uploadFiles(event){

  if ( document.getElementById('media').value.length == 0 ){
    swal("Error", "Please select file first.", "error")
    return ;
  }

  event.preventDefault();

  var formData = new FormData($('#uploadForm')[0]);

  $.each(files, function(key, value)
  {
      $.each(value, function(key, value){
        formData.append(key, value);
      })
      console.log(value);
  });

  // console.log(formData);
  // return ;
  $.ajax({

    xhr: function(){
      preload.hide()
      var xhr = new window.XMLHttpRequest();
      xhr.upload.addEventListener('progress', function(e){

        if(e.lengthComputable){
          console.log('Byte loaded : ' + e.loaded);
          console.log('Total size : ' + e.total);
          console.log('Percentage : ' + (e.loaded / e.total));

          var percentage = Math.round((e.loaded / e.total) * 100);

          $('#progressUploadBar').attr('aria-valuenow', percentage).css('width', percentage + '%')
        }
      })
      return xhr;
    },
    url: conf.api + 'upload?stage=csv',
    type: 'POST',
    data: formData,
    processData: false, // Don't process the files
    contentType: false, // Set content type to false as jQuery will tell the server its a query string request
    success: function(data, textStatus, jqXHR)
    {
      preload.hide()
          console.log(data);
          console.log(textStatus);
          console.log(jqXHR);
          setTimeout(function(){
            $('#progressbar').addClass('dn')
            swal({    title: "อัพโหลดไฟล์สำเร็จ",
              text: "กด 'รับทราบ' เพื่อดำเนินการต่อ",
              type: "success",
              showCancelButton: false,
              confirmButtonColor: "#55a0dd",
              confirmButtonText: "รับทราบ",
              closeOnConfirm: true },
            function(){
              window.location.reload()
            });
          }, 1000)

          $('#media').val('')
          // checkDataReplyFile()
          return ;
    },
    error: function(jqXHR, textStatus, errorThrown)
    {
      preload.hide()
          swal({    title: "ไม่สามารถอัพโหลดไฟล์ได้",
            text: "กรุณาลองใหม่ หรือส่งไฟล์ให้เจ้าหน้าที่ผ่านทางอีเมล์!",
            type: "error",
            showCancelButton: false,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "รับทราบ",
            closeOnConfirm: true },
          function(){

          });

          // Handle errors here
          console.log('ERRORS: ' + textStatus);
          console.log(jqXHR);
          console.log(textStatus);
          console.log(errorThrown);
          setTimeout(function(){
            $('#progressbar').addClass('dn')
          }, 1000)
          $('#progressbar').addClass('dn')
    }
  })
  return ;
}
// End uploadFiles

function prepareUpload(event){
  files = event.target.files;
  console.log(files);
}
// End prepareUpload
