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
      div.tooltip {
          position: absolute;
          text-align: center;
          width: 60px;
          height: 28px;
          padding: 2px;
          font: 12px sans-serif;
          background: lightsteelblue;
          border: 0px;
          border-radius: 8px;
          pointer-events: none;
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

  <!-- <script type="text/javascript" src="../../node_modules/d3-master/d3/dist/d3.js"></script> -->
  <script src="https://d3js.org/d3.v5.js"></script>
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
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2":( arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(78, 78, 78)", "Compair of" : "CESAREAN and " + i[0] })
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
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(78, 78, 78)", "Compair of" : "PRETERM and " + i[0] })
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
                jsonLine.push({ "x1": (arr0[0].x_axis * -1), "y1": (arr0[0].y_axis * -1), "x2": (arr1[0].x_axis * -1), "y2": (arr1[0].y_axis * -1), "stroke_width": $line_width, "stroke" : "rgb(78, 78, 78)", "Compair of" : "LBW and " + i[0] })
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
                        .style("margin-top", "30px")

      var group = svgContainer.append("g")
                  .attr("transform", "translate(" + width/2 + "," + height/2 + ")")

      var circleRadious = width/2 - (data[0].radius * 3.8)
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
                                      .attr("stroke", "rgb(255, 0, 0)")
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
</html>
