<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    svg {
      display: block;
      margin: 0 auto;
      }
    </style>
  </head>
  <body>
    <svg width="600" height="600" ></svg>
  </body>

  <script type="text/javascript" src="../../node_modules/jquery/dist/jquery.min.js" ></script>
  <script type="text/javascript" src="../../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="../../node_modules/popper.js/dist/umd/popper.min.js"></script>
  <script type="text/javascript" src="../../node_modules/sweetalert/dist/sweetalert.min.js"></script>
  <script type="text/javascript" src="../../node_modules/moment/min/moment.min.js"></script>
  <script type="text/javascript" src="../../node_modules/jquery.nicescroll/dist/jquery.nicescroll.min.js"></script>
  <script type="text/javascript" src="../../node_modules/preload.js/dist/js/preload.js"></script>
  <script type="text/javascript" src="../../node_modules/dropzone/dist/min/dropzone.min.js"></script>

  <script type="text/javascript" src="../../assets/js/stisla.js"></script>
  <script type="text/javascript" src="../../assets/js/scripts.js"></script>

  <script type="text/javascript" src="../../assets/custom/js/config.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/core.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/authen.js"></script>
  <script type="text/javascript" src="../../assets/custom/js/project.js"></script>

  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script type="text/javascript">

    preload.hide()
    // project.visualize()
    var x1 = 0, y1 = 0, x2 = 0, y2 = 0;
    var jsonCircle = [];

    var margin = {top: 50, right: 50, bottom: 50, left: 50}
    var width = 500
    var height = 500

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
                   var text_param = []
                   var label_param = []
                   var indepentent = []
                   var depentent = []
                   var array_link = []
                   // Extract data for param only
                   for (var i = 4; i < snap.length ; i++) {
                     // console.log(snap[i][0]); // Param
                     // console.log(snap[i][1]); // Labe;;
                     // console.log(snap[i][2]); // Significant for outcome 1;
                     // console.log(snap[i][3]); // Significant for outcome 2;
                     // console.log(snap[i][4]); // Significant for outcome 2;
                     text_param.push(snap[i][0])
                     label_param.push(snap[i][1])

                     if(i < (snap.length - outcome)){
                       indepentent.push(snap[i][0])
                     }else{
                       depentent.push(snap[i][0])
                     }

                     if((parseInt(snap[i][2]) >= 1) || (parseInt(snap[i][3]) == 1) || (parseInt(snap[i][4]) == 1)){
                       sig_param.push(1)
                     }else{
                       sig_param.push(0)
                     }
                   }

                   // console.log(text_param);
                   // console.log(label_param);
                   // console.log(indepentent);
                   // console.log(depentent);

                   // console.log(eachdegree);

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
                     // startPoint = parseInt(startPoint)
                     // console.log(startPoint);

                     var x = calculatePoint('x', startPoint, radious_x)
                     var y = calculatePoint('y', startPoint, radious_y)

                     // if(i == 0){
                     //   first_x = x; first_y = y;
                     // }else if(i == 1){
                     //   jsonLine.push({ "x1": first_x, "y1": first_y, "x2": x, "y2": y, "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" })
                     // }else if(i == point - 1){
                     //   jsonLine.push({ "x1": prev_x, "y1": prev_y, "x2": x, "y2": y, "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" })
                     // }else{
                     //   jsonLine.push({ "x1": prev_x, "y1": prev_y, "x2": x, "y2": y, "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" })
                     // }

                     if($outcome_c == 0){
                        param_label.push(depentent[outcome_ref])
                        console.log("Outcome " + depentent[outcome_ref]);
                        jsonCircle.push({ "x_axis": x, "y_axis": y, "radius": (distancex/2), "color" : "rgb(0, 148, 255)", "degree" : startPoint, "param" : depentent[outcome_ref]})
                        outcome_ref++
                     }else{
                        if(sig_param[$independent] == 1){
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3), "color" : "rgb(255, 99, 0)", "degree" : startPoint, "param" : indepentent[factor_ref] })
                        }else{
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3), "color" : "rgb(240, 240, 240)", "degree" : startPoint, "param" : indepentent[factor_ref] })
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

    function displayVisualize(data, text_param, ed, snap){

      // console.log(ed);
      var width = 600
      var height = 600
      var origin = { x: 0, y: 0 };
      var jsonLine = [];

      console.log(data);

      $index = 0
      snap.forEach(i=>{
        if($index >= 4){
          i.forEach((k, x) => {
            var jj = i[0]
            if(x == 2){
              var arr0 = data.filter(d => d.param == "CESAREAN");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2":( arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)", "Compair of" : "CESAREAN and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "CESAREAN and " + i[0] })
              }
            }else if(x == 3){
              var arr0 = data.filter(d => d.param == "PRETERM");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)", "Compair of" : "PRETERM and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "PRETERM and " + i[0] })
              }
            }else if(x == 4){
              var arr0 = data.filter(d => d.param == "LBW");
              var arr1 = data.filter(d => d.param == jj);
              if(parseInt(k) >= 1){
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)", "Compair of" : "LBW and " + i[0] })
              }else{
                // jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": 1, "stroke" : "rgb(232, 232, 232)", "Compair of" :  "LBW and " + i[0] })
              }
            }
          })
        }
        $index++
      })


      //
      // var jsonCircles = [
      //   { "x_axis": 200 + (width/2), "y_axis": 0 + (height/2), "radius": 38, "color" : "rgb(0, 148, 255)" },
      //   { "x_axis": 161.80339887498948 + (width/2), "y_axis": 117.55705045849463 + (height/2), "radius": 20, "color" : "rgb(255, 107, 0)"},
      //   { "x_axis": 61.80339887498949 + (width/2), "y_axis": 190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      //   { "x_axis": -61.80339887498947 + (width/2), "y_axis": 190.21130325903073 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      //   { "x_axis": -161.80339887498945 + (width/2), "y_axis": 117.55705045849464 + (height/2)  , "radius": 30, "color" : "rgb(0, 148, 255)"},
      //   { "x_axis": -200 + (width/2), "y_axis": 0 + (height/2), "radius": 20, "color" : "red"},
      //   { "x_axis": -161.80339887498948 + (width/2), "y_axis": -117.5570504584946 + (height/2), "radius": 20, "color" : "red"},
      //   { "x_axis": -61.80339887498951 + (width/2), "y_axis": -190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      //   { "x_axis": 61.80339887498945 + (width/2), "y_axis": -190.21130325903073 + (height/2), "radius": 30, "color" : "rgb(0, 148, 255)"},
      //   { "x_axis": 161.80339887498945 + (width/2), "y_axis": -117.55705045849467 + (height/2), "radius": 20, "color" : "red"},
      // ];

        var svgContainer = d3.select("svg")
                          .attr("width", width)
                          .attr("height", height)

        var group = svgContainer.append("g")
                    .attr("transform", "translate(" + width/2 + "," + height/2 + ")")

        var circleRadious = width/2 - (data[0].radius * 3.8)
         group.append("circle")
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
                    .attr("stroke", i.stroke);
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
            .attr("transform", function(d, i) { return "rotate(" + (-90 + ((360 / dial.length) * i)) + ")"; });

          group.append("circle")
                      .attr("cx", i.x_axis * -1 )
                      .attr("cy", i.y_axis * -1 )
                      .attr("r", i.radius)
                      .style("fill", i.color);


          $c++;
        })


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
    }

  </script>
</html>
