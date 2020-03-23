<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Layout &rsaquo; Top Navigation &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css" >
  <link rel="stylesheet" href="../../node_modules/@fortawesome/fontawesome-free/css/all.css">
  <link rel="stylesheet" href="../../node_modules/sweetalert/dist/sweetalert.css">
  <link rel="stylesheet" href="../../node_modules/preload.js/dist/css/preload.css">
  <link rel="stylesheet" href="../../node_modules/dropzone/dist/min/dropzone.min.css">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/components.css">

  <link rel="stylesheet" href="../../assets/custom/css/style.css">

  <style media="screen">

  circle.node {
    stroke: #fff;
    stroke-width: 3px;
  }

  line.link {
      stroke-width: 2px;
      stroke: #999;
      stroke-opacity: 0.6;
  }

  marker#arrow {
      stroke: #999;
      fill: #999;
  }

  html, body{
    background: #fff !important;
    overflow-y:hidden;
    height:100%;
  }
  </style>
</head>

<body style="background: #fff;">

  <nav class="navbar navbar-dark fixed-top" style="left: 0px; right: 0px; border: solid; border-width: 0px 0px 1px 0px; border-color: rgb(237, 237, 237); background: rgb(255, 255, 255);">
    <a class="navbar-brand text-dark" href="#"><span class="text-danger">FXPLOR</span> Visualization</a>
    <!-- <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid" style="background: #fff;">
    <div class="row" style="margin-top: 70px; background: #fff;">
      <div class="col-12 pt-3">
        <div class="row">
          <div class="col-12 col-sm-12 pb-2">
            <button type="button" name="button" class="btn btn-danger btn-sm bsdn" onclick="window.location='project'"><i class="fas fa-chevron-left"></i> Back to FXPLOR</button>
            <button type="button" name="button" class="btn btn-primary btn-sm bsdn" onclick="window.location='project'"><i class="fas fa-bars"></i> History</button>
            <button type="button" name="button" class="btn btn-primary btn-sm bsdn" onclick="window.location='project'"><i class="fas fa-play"></i> Generate visualization</button>
          </div>
        </div>

        <div class="row">
          <div class="col-12 col-sm-3 col-md-3 col-lg-4 col-xl-6 pr-0" id="tableData">
            <h6 class="mt-3">Independent variable list</h6>
            <div class="row">
              <div class="col-12">
                <div class="customNiceScroll p-0" style="height: 200px; overflow: visible; border: solid; border-width: 0px 1px 0px 0px; border-color: rgb(232, 232, 232);">
                  <div id="lraList">
                    <table class="table table-striped table-sm table-bordered">
                      <thead id="lraListHeader" style="background: rgb(0, 133, 255);">
                      </thead>
                      <thead id="lraListBody">
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-12 col-sm-5 col-md-5 col-lg-8 col-xl-6">
            <div class="card mt-0" style="box-shadow: none;">
              <div class="card-body text-center" id="vizCard" style="height: 600px; box-shadow: none;">
                <svg width="100%" height="700"></svg>
              </div>
            </div>
          </div>


        </div>
      </div>
    </div>
  </div>

  <div class="dataPanal" style="bottom: 0px; left: 0px; width: 400px; position: fixed; background: rgb(228, 228, 228); height: 260px; background: rgb(245, 245, 245);" >
    <div class="p-2" style="background: #fff;">
      <h6 class="mt-3">Output console</h6>
    </div>
    <div class="p-3" style="font-size: 0.9em;">
      Null deviance: 1501.5 on 1532 degrees of freedom<br>
     Residual deviance: 1438.1 on 1521 degrees of freedom<br>
     AIC: 1462.1<br>
     Number of Fisher Scoring iterations: 4<br>
    </div>
  </div>


  <!-- General JS Scripts -->
  <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="../../node_modules/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="../../node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="../../node_modules/preload.js/dist/js/preload.js"></script>
  <script type="text/javascript" src="../../node_modules/dropzone/dist/min/dropzone.min.js"></script>
  <!-- <script type="text/javascript" src="../../node_modules/d3-master/d3/dist/d3.js"></script> -->
  <script src="https://d3js.org/d3.v5.js"></script>

  <script type="text/javascript" src="../../assets/js/stisla.js"></script>
  <script type="text/javascript" src="../../assets/js/scripts.js"></script>

  <script type="text/javascript" src="../../assets/custom/js/config.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/core.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/authen.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/project.js"></script>

  <script type="text/javascript">

    // preload.hide()
    // project.visualize()
    $('.customNiceScroll').height(($('body').height() - 260 - 200) + 'px' )
    $('.dataPanal').width($('#tableData').width() + 20)
    var x1 = 0, y1 = 0, x2 = 0, y2 = 0;
    var jsonCircle = [];

    $displayWidth = $('#vizCard').width()
    $displayheight = $('#vizCard').height()

    var margin = {top: 50, right: 50, bottom: 50, left: 50}
    var width = 400
    var height = 400

    var jxr = $.post(conf.api + 'project_visualize?stage=get_input_data', function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if(fnc.json_exist(snap)){
                   $n_row = snap.length
                   var point = $n_row - 4
                   var outcome = snap[0].length - 2
                   var radious_x = width/2 - 50
                   var radious_y = height/2 - 50
                   var central_radious = width/2 - 60
                   var point_outcome = parseInt(point/outcome)
                   var eachdegree = (360/point);

                   var sig_param = []
                   var sig_param_value = []
                   var text_param = []
                   var label_param = []
                   var indepentent = []
                   var depentent = []
                   var array_link = []
                   // Extract data for param only
                   for (var i = 4; i < snap.length ; i++) {
                     text_param.push(snap[i][0])
                     label_param.push(snap[i][1])

                     if(i < (snap.length - outcome)){
                       indepentent.push(snap[i][0])
                     }else{
                       depentent.push(snap[i][0])
                     }

                     if((parseInt(snap[i][2]) >= 1) || (parseInt(snap[i][3]) >= 1) || (parseInt(snap[i][4]) >= 1)){
                       sig_param.push(1)
                       // sig_param_value.push(0)
                     }else{
                       sig_param.push(0)
                       // sig_param_value.push(0)
                     }
                   }

                   var startPoint = 90 - eachdegree;
                   var originalOrigin = startPoint;

                   // Calculate distince
                   for (var i = 0; i < point; i++) {
                     startPoint = startPoint + eachdegree
                     startPoint = parseInt(startPoint)
                     if((i == 0) || (i == 1)){
                       if(i == 0){
                         x1 = calculatePoint('x', startPoint, central_radious)
                         y1 = calculatePoint('y', startPoint, central_radious)
                       }else{
                         x2 = calculatePoint('x', startPoint, central_radious)
                         y2 = calculatePoint('y', startPoint, central_radious)
                       }
                     }
                   }
                   var distancex = distance(x1, y1, x2, y2);


                   // Calculate coordinate
                   $outcome_c = 0
                   startPoint = originalOrigin
                   var param_label = [];
                   var outcome_ref = 0
                   var factor_ref = 0
                   $independent = 0

                   var first_x = 0; var first_y = 0;

                   for (var i = 0; i < point; i++) {
                     startPoint = startPoint + eachdegree
                     var x = calculatePoint('x', startPoint, radious_x)
                     var y = calculatePoint('y', startPoint, radious_y)

                     if($outcome_c == 0){
                        param_label.push(depentent[outcome_ref])
                        console.log("Outcome " + depentent[outcome_ref]);
                        if(i == 0){
                          jsonCircle.push({ "x_axis": x, "y_axis": y, "radius": (distancex/2) + ((distancex/2) * 0.4), "color" : "rgb(0, 148, 255)", "degree" : startPoint, "param" : depentent[outcome_ref]})
                        }else{
                          jsonCircle.push({ "x_axis": x, "y_axis": y, "radius": (distancex/2.2), "color" : "rgb(0, 148, 255)", "degree" : startPoint, "param" : depentent[outcome_ref]})
                        }
                        outcome_ref++
                     }else{
                        if(sig_param[$independent] == 1){
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3.5), "color" : "rgb(255, 99, 0)", "degree" : startPoint, "param" : indepentent[factor_ref] })
                        }else{
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3.5), "color" : "rgb(230, 230, 230)", "degree" : startPoint, "param" : indepentent[factor_ref] })
                        }
                        param_label.push(indepentent[factor_ref])
                        factor_ref++
                        $independent++;
                     }
                     if($outcome_c == point_outcome){
                       $outcome_c = 0;
                     }else{
                       $outcome_c ++
                     }

                     // console.log(param_label);

                   }
                   // console.log(jsonCircle);
                   displayVisualize(jsonCircle, param_label, eachdegree, snap)

                   $c = 0
                   snap.forEach(i=>{
                     if($c == 0){
                       $('#lraListHeader').empty()
                       $('#lraListHeader').append('<tr style="background: rgb(1, 122, 249) !important;">')
                       i.forEach(k => {
                         $('#lraListHeader').append('<th class="text-white">' + k + '</th>')
                       })
                       $('#lraListHeader').append('</tr>')

                       $('#lraListHeader').append('<tr style="background: #fff;"><td colspan="5"><div class="custom-control custom-checkbox">' +
                        '<input type="checkbox" class="custom-control-input" id="customCheck1" checked>' +
                        '<label class="custom-control-label" for="customCheck1"><strong>Check all</strong></label>' +
                      '</div></td></tr>')
                     }else{
                       $('#lraListBody').append('<tr>')
                       $v = 0
                       i.forEach(k => {
                         if($v == 0){
                           if($c > 3){
                             $('#lraListBody').append('<td><div class="custom-control custom-checkbox">' +
                              '<input type="checkbox" class="custom-control-input" id="customCheck1" checked>' +
                              '<label class="custom-control-label" for="customCheck1">' + k + '</label>' +
                            '</div></td>')
                          }else{
                              $('#lraListBody').append('<td><strong>' + k + '</strong></td>')
                          }

                          }else{
                            $('#lraListBody').append('<td>' + k + '</td>')
                          }
                          $v++;
                       })
                       $('#lraListBody').append('</tr>')
                     }



                     $c++;
                   })
                 }
               })


    // ------------------------


    function calculateCOS(degree){
      degree = parseInt(degree)
      if(degree == 0){ return 1}
      else if(degree == 90){ return 0}
      else if(degree == 180){ return -1}
      else if(degree == 270){ return 0}
      else{
        return Math.cos(((degree) * Math.PI)/180)
      }
    }

    function calculateSIN(degree){
      degree = parseInt(degree)
      if(degree == 0){ return 0}
      else if(degree == 90){ return 1}
      else if(degree == 180){ return 0}
      else if(degree == 270){ return -1}
      else{
        return Math.sin(((degree) * Math.PI)/180)
      }
    }

    function calculatePoint(side, degree, rad){
      degree = parseInt(degree)
      if(side == 'x'){
        if(degree == 0){ return 1 * rad }
        else if(degree == 90){ return 0 * rad }
        else if(degree == 180){ return -1 * rad }
        else if(degree == 270){ return 0 * rad  }
        else{
          return rad * Math.cos(((degree) * Math.PI)/180)
        }
      }else{
        if(degree == 0){ return 0 * rad}
        else if(degree == 90){ return 1 * rad}
        else if(degree == 180){ return 0 * rad}
        else if(degree == 270){ return -1 * rad }
        else{
          return rad * Math.sin(((degree) * Math.PI)/180)
        }
      }
    }

    function distance(lat1,lon1,lat2,lon2) {
      var d = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2))
    	return d;
    }

    function getExplorvalue(id){
      console.log(id);
    }

    function displayVisualize(data, text_param, ed, snap){

      // console.log(ed);
      var width = 600
      var height = 600
      var origin = { x: 0, y: 0 };
      var jsonLine = [];

      // console.log(data);
      // console.log(snap);

      $index = 0
      snap.forEach(i=>{
        if($index >= 4){
          i.forEach((k, x) => {
            var jj = i[0]
            $line_width = 3
            if(x == 2){
              if(parseInt(i[2]) == 1){
                $line_width = 9
              }else if(parseInt(i[2]) == 2){
                $line_width = 5
              }
              var arr0 = data.filter(d => d.param == "CESAREAN");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2":( arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(126, 126, 126)", "Compair of" : "CESAREAN and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "CESAREAN and " + i[0] })
              }
            }else if(x == 3){
              if(parseInt(i[2]) == 1){
                $line_width = 9
              }else if(parseInt(i[2]) == 2){
                $line_width = 5
              }
              var arr0 = data.filter(d => d.param == "PRETERM");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(126, 126, 126)", "Compair of" : "PRETERM and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "PRETERM and " + i[0] })
              }
            }else if(x == 4){
              if(parseInt(i[2]) == 1){
                $line_width = 9
              }else if(parseInt(i[2]) == 2){
                $line_width = 5
              }
              var arr0 = data.filter(d => d.param == "LBW");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(126, 126, 126)", "Compair of" : "LBW and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "LBW and " + i[0] })
              }
            }
          })
        }
        $index++
      })

      var svgContainer = d3.select("svg")
                        .attr("width", width)
                        .attr("height", height)
                        .style("margin-top", "0px")

      var group = svgContainer.append("g")
                  .attr("transform", "translate(" + width/2 + "," + height/2 + ")")

      var circleRadious = width/2 - (data[0].radius) - 130
      var circle = group.append("circle")
                  .attr("r", circleRadious)
                  .style("fill", "none")
                  .style("stroke", "rgb(236, 236, 236)");

      $c = 0

      var text_ele = []

      jsonLine.forEach(i=>{
        var line = group.append("line")
                  .attr("x1", i.x1)
                  .attr("y1", i.y1)
                  .attr("x2", i.x2)
                  .attr("y2", i.y2)
                  .attr("stroke-width", i.stroke_width)
                  .attr("stroke", i.stroke)
                  .style("cursor", "pointer")
                  .on("mouseover", function(){
                    var c_element = d3.select(this)
                                      .attr("stroke-width", i.stroke_width * 1.25)
                                      .attr("stroke", "rgb(36, 36, 36)")
                  })
                  .on("mouseout", function(){
                    var c_element = d3.select(this)
                                      .attr("stroke-width", i.stroke_width)
                                      .attr("stroke", i.stroke)
                  });
        if(i.stroke_width == 1){
          line.style("stroke-dasharray","5,5")
        }

      })

      data.forEach(i=>{

        var x = i.degree
        var rad = i.radius
        var nx = (40 * calculateCOS(i.degree) + i.x_axis) + width/2
        var ny = (40 * calculateSIN(i.degree) + i.y_axis) + height/2

        dial = text_param;

        // Position text at X=radius, Y=0 and rotate around the origin to get final position
        group.selectAll("text")
          .data(dial)
          .enter()
          .append("text")
          .attr("x", circleRadious + 40)
          // tweak digit Y position a little to ensure it's centred at desired position
          .attr("y", "0.1em")
          .text(function(d, i) { return d; })
          .attr("transform", function(d, i) {
            return "rotate(" + (-90 + ((360 / dial.length) * i)) + ")";
          });


        var param_circle = group.append("circle")
                    .attr("id", "circle_" + $c )
                    .attr("cx", i.x_axis * -1 )
                    .attr("cy", i.y_axis * -1 )
                    .attr("r", i.radius)
                    .style("fill", i.color)
                    .style("cursor", 'pointer')
                    .on("click", function(){
                      var c_element = d3.select(this)
                      getExplorvalue(c_element.attr('id'))
                    })
                    .on("mouseover", function(){
                      var c_element = d3.select(this)
                                        .attr("r", i.radius * 1.25)
                    })
                    .on("mouseout", function(){
                      var c_element = d3.select(this)
                                        .attr("r", i.radius)
                    });
        $c++;
      })

      d3.select("#circle_0")



      var curAngle = 0;
      var interval = null;

      svgContainer.call(d3.drag().on('drag', dragged));

      function dragged() {
                  var r = {
                      x: d3.event.y,
                      y: d3.event.x
                  };
                  svgContainer.attr("transform","rotate(" + r.x + "," + (origin.x) + "," + (origin.y) + ")" );
              };

      // Create Event Handlers for mouse
      function handleMouseOver(d, i) {  // Add interactivity

            // Use D3 to select element, change color and size
            d3.select(this).attr({
              fill: "orange",
              // r: radius * 2
            });

            // Specify where to put label of text
            svgContainer.append("text").attr({
               id: "t" + d.x + "-" + d.y + "-" + i,  // Create an id for text so we can select it later for removing on mouseout
                x: function() { return xScale(d.x) - 30; },
                y: function() { return yScale(d.y) - 15; }
            })
            .text(function() {
              return [d.x, d.y];  // Value of the text
            });
          }
    }

  </script>

  <script type="text/javascript">

    if(current_project == null){
      window.location = './project.php'
    }
    console.log(current_project);

    $(document).ready(function(){

      project.getDomain()
      $("body").niceScroll();
      $('.customNiceScroll').niceScroll();

      setTimeout(function(){
        user.init('init')
        project.getInfo()
        // project.getFileData()
        project.getDataManagementInfo('getDataManagementInfo')
        project.visualize()
        $('#btnSidebar').trigger('click')
      }, 300)



    })

    $(function(){
      $('.project-create-form').submit(function(){
        project.create()
      })
    })

    function setProjectId(){
      $('.txtIdProject').val(current_project)
    }

  </script>

</body>
</html>
