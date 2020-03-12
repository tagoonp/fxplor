var user = {
  init(lh){
    var jxr_user = $.post(conf.api + 'authen?stage=info', {uid: current_user, role: current_role }, function(){}, 'json')
                    .always(function(snap){
                      // console.log(snap);
                      if(fnc.json_exist(snap)){
                        snap.forEach(i=>{
                          $('.userFullname').text(i.fname + ' ' + i.lname)
                        })
                      }else{
                        window.location = conf.domain + 'authen'
                      }
                      if(lh == 'init'){ preload.hide() }
                    })
  }
}
