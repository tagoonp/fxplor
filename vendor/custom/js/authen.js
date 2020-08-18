var authen = {
  login(param){
    var jxr = $.post(conf.api + 'authen.php?stage=login', param, function(){}, 'json')
               .always(function(snap){
                 if(snap.status = 'Success'){

                 }else{
                   
                 }
               })
  }
}
