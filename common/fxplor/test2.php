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

                     if((snap[i][2] == '1') || (snap[i][3] == '1') || (snap[i][4] == '1')){
                       sig_param.push(1)
                     }else{
                       sig_param.push(0)
                     }
                   }

                   console.log(text_param);
                   console.log(label_param);
                   console.log(indepentent);
                   console.log(depentent);

                   // console.log(eachdegree);

                   var startPoint = 0 - eachdegree;
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

                   // Set indepentent param
                   // for (var i = 0; i < ($n_row - outcome); i++) {
                   //   indepentent.push()
                   // }

                   // Calculate coordinate
                   $outcome_c = 0
                   startPoint = originalOrigin
                   var param_label = [];
                   var outcome_ref = 0
                   var factor_ref = 0
                   $independent = 0
                   for (var i = 0; i < point; i++) {
                     startPoint = startPoint + eachdegree
                     // startPoint = parseInt(startPoint)
                     // console.log(startPoint);

                     var x = calculatePoint('x', startPoint, radious_x)
                     var y = calculatePoint('y', startPoint, radious_y)

                     // console.log(startPoint + ' -> x => ' + x  + ', y => ' + y);

                     // var x = calculatePoint('x', startPoint, central_radious) + (central_radious * calculateCOS(startPoint))
                     // var y = calculatePoint('y', startPoint, central_radious) + (central_radious * calculateSIN(startPoint))


                     //

                     if($outcome_c == 0){
                     //   console.log('Start point');
                     //   console.log('x => ' + x + ', y => ' + y);
                     //   x = x + central_radious
                     //
                     //   // var x0 = ((distancex/2) * calculateCOS(startPoint) + x) + (central_x - 50) - (distancex)
                     //   // var y0 = ((distancex/2) * calculateSIN(startPoint) + y) + (central_x - 50)
                     //
                     //   // console.log('New x => ' + x0 + ', y => ' + y0);
                     //   // console.log('x => ' + calculatePoint('x', startPoint, radious) + ' y => ' + calculatePoint('y', startPoint, radious));
                       param_label.push(depentent[outcome_ref])
                       console.log(depentent[outcome_ref]);
                       outcome_ref++
                       jsonCircle.push({ "x_axis": x, "y_axis": y, "radius": (distancex/2), "color" : "rgb(0, 148, 255)", "degree" : startPoint})
                     }else{
                     //   console.log('Indicator point');
                     //   console.log('x => ' + x + ', y => ' + y);
                     //   // var x0 = (distancex/2) * calculateCOS(startPoint)  + x
                     //   // var y0 = (distancex/2) * calculateSIN(startPoint)  + y
                     //   // var x0 = (distancex/2) * calculateCOS(startPoint) + x + distancex
                     //   // var y0 = (distancex/2) * calculateSIN(startPoint) + y + distancex
                     //   // jsonCircle.push({ "x_axis": calculatePoint('x', startPoint, radious) + radious, "y_axis": calculatePoint('y', startPoint, radious) + radious, "radius": 30, "color" : "rgb(207, 207, 207)" })
                        if(sig_param[$independent] == 1){
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3), "color" : "rgb(255, 99, 0)", "degree" : startPoint })
                        }else{
                          jsonCircle.push({ "x_axis": x , "y_axis": y , "radius": (distancex/3), "color" : "rgb(240, 240, 240)", "degree" : startPoint })
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
                   displayVisualize(jsonCircle, param_label, eachdegree)
                 }
               })


    // ------------------------

    // var point = 22
    // var outcome = 3
    // var radious = 200
    // var point_outcome = parseInt(point/outcome)
    // var eachdegree = 360/point;
    // var startPoint = 0 - eachdegree;
    //
    // var x1 = 0, y1 = 0, x2 = 0, y2 = 0;
    // $outcome_c = 0;
    // for (var i = 0; i < point; i++) {
    //   startPoint = startPoint + eachdegree
    //   startPoint = parseInt(startPoint)
    //   if($outcome_c == 0){
    //     console.log("Print outcome");
    //   }
    //   console.log('Degree ' + startPoint + ' => ' + calculatePoint('x', startPoint, radious) + ', ' + calculatePoint('y', startPoint, radious));
    //   if($outcome_c == point_outcome){
    //     $outcome_c = 0;
    //   }else{
    //     $outcome_c ++
    //   }
    //
    //   if((i == 0) || (i == 1)){
    //     if(i == 0){
    //       x1 = calculatePoint('x', startPoint, radious)
    //       x1 = calculatePoint('y', startPoint, radious)
    //     }else{
    //       x2 = calculatePoint('x', startPoint, radious)
    //       x2 = calculatePoint('y', startPoint, radious)
    //     }
    //   }
    //
      // console.log("Distance = " + distance(x1, y1, x2, y2));
    // }

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

    function displayVisualize(data, text_param, ed){

      // console.log(ed);
      var width = 600
      var height = 600
      var origin = { x: 300, y: 300 };
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

        // console.log(jsonCirclesx);
      //
      //   var jsonLine = [
      //     { "x1": 200 + (width/2), "y1": 0 + (height/2), "x2": 161.80339887498948  + (height/2) , "y2":117.55705045849463 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" },
      //     { "x1": 161.80339887498948  + (height/2), "y1": 117.55705045849463 + (height/2), "x2":  61.80339887498949 + (width/2), "y2": 190.2113032590307 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" }
      //   ];
      //
      //
      //
        var svgContainer = d3.select("svg")

        // for (var i = 0; i < text_param.length; i++) {
        //   var textLabels = svgContainer.append("text")
        //                     .attr("x", ((40 * calculateCOS(data[i].degree)) + data[i].x_axis) + width/2 )
        //                     .attr("y", ((40 * calculateSIN(data[i].degree)) + data[i].y_axis) + height/2 )
        //                     .text(text_param[i])
        //                     .attr("transform", "rotate(10)")
        //                     .attr("font-family", "sans-serif")
        //                     .attr("font-size", "20px")
        //                     .attr("fill", "red");
        // }


        var group = svgContainer.append("g")
                    // .attr("transform", "translate(" + width/2 + "," + height/2 + ")")

                    // ((distancex/2) * calculateCOS(startPoint) + x) + (central_x - 50) - (distancex)
        var circleRadious = width/2 - (data[0].radius * 3.8)
         group.append("circle")
              .attr("r", circleRadious)
              .attr("transform", "translate(" + (width/2) + ", " + (height/2) + ")")
              .style("fill", "none")
              .style("stroke", "rgb(232, 232, 232)");
        $c = 0

        var text_ele = []

        data.forEach(i=>{

        })

        data.forEach(i=>{



          // var subgroup = group.append("g")
          //               .attr("x", ((40 * calculateCOS(i.degree)) + i.x_axis) + width/2 )
          //               .attr("y", ((40 * calculateSIN(i.degree)) + i.y_axis) + height/2 )
          //               .text(text_param[$c])
          //               .attr("transform", "rotate(10)")
          //               .attr("font-family", "sans-serif")
          //               .attr("font-size", "20px")
          //               .attr("fill", "red");

          // var textLabels = svgContainer.append("text")
          //                   .attr("x", ((40 * calculateCOS(i.degree)) + i.x_axis) + width/2 )
          //                   .attr("y", ((40 * calculateSIN(i.degree)) + i.y_axis) + height/2 )
          //                   .text(text_param[$c])
          //                   .attr("transform", "rotate(10)")
          //                   .attr("font-family", "sans-serif")
          //                   .attr("font-size", "20px")
          //                   .attr("fill", "red");

          var circles = group.append("circle")
                                    .attr("cx", i.x_axis + width/2 )
                                    .attr("cy", i.y_axis  + height/2 )
                                    .attr("r", i.radius)
                                    .style("fill", i.color);

                                    //Add the SVG Text Element to the svgContainer
          var x = i.degree
          var rad = i.radius
          var nx = (40 * calculateCOS(i.degree) + i.x_axis) + width/2
          var ny = (40 * calculateSIN(i.degree) + i.y_axis) + height/2

          // console.log(x);
          console.log(text_param[$c] + ' ' + x);

          if((x >= 90) && (x <= 270)){

            // var thisWidth = text_param[$c].getComputedTextLength()
            // console.log(thisWidth);

            // console.log(i.degree);
            if((x > 180) && (x < 270)){
              group.append("text")
                    .attr("dx", ((40 * calculateCOS(i.degree) + i.x_axis) + width/2) - 20)
                    .attr("dy", ((40 * calculateSIN(i.degree) + i.y_axis) + height/2))
                    .text(text_param[$c])
            }else{
              group.append("text")
                    .attr("dx", ((40 * calculateCOS(i.degree) + i.x_axis) + width/2) - 20)
                    .attr("dy", ((40 * calculateSIN(i.degree) + i.y_axis) + height/2) + 20)
                    .text(text_param[$c])
            }

          }else{
            group.append("text")
                  .attr("dx", ((40 * calculateCOS(i.degree) + i.x_axis) + width/2))
                  .attr("dy", ((40 * calculateSIN(i.degree) + i.y_axis) + height/2))
                  .text(text_param[$c])
          }



          $c++;
        })

        // text_ele.forEach(i=>{
        //   i.attr("transform", "rotate(20)")
        // })

        // var container = svg.append("g")


        var curAngle = 0;
        var interval = null;

        svgContainer.call(d3.drag().on('drag', dragged));

        function dragged() {
                    var r = {
                        x: d3.event.y,
                        y: d3.event.x
                    };
                    group.attr("transform","rotate(" + r.x + "," + origin.x + "," + origin.y + ")" );
                };
    }

  </script>

  <script type="text/javascript">

  // var width = 600
  // var height = 600
  // var origin = {
  //               x: 300,
  //               y: 300
  //           };
  // //
  //   var jsonCirclesx = [
  //     { "x_axis": 200 + (width/2), "y_axis": 0 + (height/2), "radius": 38, "color" : "rgb(0, 148, 255)" },
  //     { "x_axis": 161.80339887498948 + (width/2), "y_axis": 117.55705045849463 + (height/2), "radius": 20, "color" : "rgb(255, 107, 0)"},
  //     { "x_axis": 61.80339887498949 + (width/2), "y_axis": 190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
  //     { "x_axis": -61.80339887498947 + (width/2), "y_axis": 190.21130325903073 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
  //     { "x_axis": -161.80339887498945 + (width/2), "y_axis": 117.55705045849464 + (height/2)  , "radius": 30, "color" : "rgb(0, 148, 255)"},
  //     { "x_axis": -200 + (width/2), "y_axis": 0 + (height/2), "radius": 20, "color" : "red"},
  //     { "x_axis": -161.80339887498948 + (width/2), "y_axis": -117.5570504584946 + (height/2), "radius": 20, "color" : "red"},
  //     { "x_axis": -61.80339887498951 + (width/2), "y_axis": -190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
  //     { "x_axis": 61.80339887498945 + (width/2), "y_axis": -190.21130325903073 + (height/2), "radius": 30, "color" : "rgb(0, 148, 255)"},
  //     { "x_axis": 161.80339887498945 + (width/2), "y_axis": -117.55705045849467 + (height/2), "radius": 20, "color" : "red"},
  //   ];
  //
  //   // console.log(jsonCirclesx);
  // //
  // //   var jsonLine = [
  // //     { "x1": 200 + (width/2), "y1": 0 + (height/2), "x2": 161.80339887498948  + (height/2) , "y2":117.55705045849463 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" },
  // //     { "x1": 161.80339887498948  + (height/2), "y1": 117.55705045849463 + (height/2), "x2":  61.80339887498949 + (width/2), "y2": 190.2113032590307 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" }
  // //   ];
  // //
  // //
  // //
  //   var svgContainer = d3.select("svg")
  //   var group = svgContainer.append("g")
  // //
  //   console.log(jsonCircle);
  //   var x = JSON.stringify(jsonCircle)
  //   console.log(x);
  //
  //   x.forEach(i=>{
  //     console.log(i);
  //     var circles = group.append("circle")
  //                               .attr("cx", i.x_axis)
  //                               .attr("cy", i.y_axis)
  //                               .attr("r", i.radius)
  //                               .style("fill", i.color);
  //   })
  //
  // //
  // //   jsonLine.forEach(i=>{
  // //     var line = group.append("line")
  // //                               .attr("x1", i.x1)
  // //                               .attr("y1", i.y1)
  // //                               .attr("x2", i.x2)
  // //                               .attr("y2", i.y2)
  // //                               .attr("stroke-width", i.stroke_width)
  // //                               .attr("stroke", i.stroke);
  // //   })
  // //
  // //
  // //
  // //   var curAngle = 0;
  // //   var interval = null;
  // //
  // //   group.call(d3.drag().on('drag', dragged));
  // //
  // //   function dragged() {
  // //               var r = {
  // //                   x: d3.event.y,
  // //                   y: d3.event.x
  // //               };
  // //               group.attr("transform","rotate(" + r.x + "," + origin.x + "," + origin.y + ")" );
  // //           };
  // //
  // //
  // //


  </script>
</html>
