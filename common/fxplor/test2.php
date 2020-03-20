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

    var jxr = $.post(conf.api + 'project_visualize?stage=get_input_data', function(){}, 'json')
               .always(function(snap){
                 console.log(snap);
                 if(fnc.json_exist(snap)){

                   // console.log(snap[0].data[0].data.length);
                   // console.log(snap[0].data.length);

                   $n_row = snap[0].length
                   console.log(snap[0][0]);
                   console.log($('svg').width());

                   var point = $n_row - 4
                   var outcome = snap[0].data[0].data.length - 2
                   var radious = $('svg').width()/2
                   var point_outcome = parseInt(point/outcome)
                   var eachdegree = 360/point;
                   var startPoint = 0 - eachdegree;

                   return ;


                   $outcome_c = 0;
                   for (var i = 0; i < point; i++) {
                     startPoint = startPoint + eachdegree
                     startPoint = parseInt(startPoint)
                     if($outcome_c == 0){
                       console.log("Print outcome");
                     }
                     console.log('Degree ' + startPoint + ' => ' + calculatePoint('x', startPoint, radious) + ', ' + calculatePoint('y', startPoint, radious));
                     if($outcome_c == point_outcome){
                       $outcome_c = 0;
                     }else{
                       $outcome_c ++
                     }

                     if((i == 0) || (i == 1)){
                       if(i == 0){
                         x1 = calculatePoint('x', startPoint, radious)
                         x1 = calculatePoint('y', startPoint, radious)
                       }else{
                         x2 = calculatePoint('x', startPoint, radious)
                         x2 = calculatePoint('y', startPoint, radious)
                       }
                     }

                     console.log("Distance = " + distance(x1, y1, x2, y2));
                   }

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
    //   console.log("Distance = " + distance(x1, y1, x2, y2));
    // }

    function calculatePoint(side, degree, rad){
      degree = parseInt(degree)
      if(side == 'x'){
        if(degree == 0){ return 1 * rad }
        else if(degree == 90){ return 0 * rad }
        else if(degree == 180){ return -1 * rad }
        else if(degree == 270){ return 0 * rad  }
        else{
          return rad * Math.cos(((startPoint) * Math.PI)/180)
        }
      }else{
        if(degree == 0){ return 0 * rad}
        else if(degree == 90){ return 1 * rad}
        else if(degree == 180){ return 0 * rad}
        else if(degree == 270){ return -1 * rad }
        else{
          return rad * Math.sin(((startPoint) * Math.PI)/180)
        }
      }
    }

    function distance(lat1,lon1,lat2,lon2) {
      var d = Math.sqrt(Math.pow((x1 - x2), 2) + Math.pow((y1 - y2), 2))
    	return d;
    }

  </script>

  <script type="text/javascript">

  var width = 600
  var height = 600
  var origin = {
                x: 300,
                y: 300
            };

    var jsonCircles = [
      { "x_axis": 200 + (width/2), "y_axis": 0 + (height/2), "radius": 38, "color" : "rgb(0, 148, 255)" },
      { "x_axis": 161.80339887498948 + (width/2), "y_axis": 117.55705045849463 + (height/2), "radius": 20, "color" : "rgb(255, 107, 0)"},
      { "x_axis": 61.80339887498949 + (width/2), "y_axis": 190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      { "x_axis": -61.80339887498947 + (width/2), "y_axis": 190.21130325903073 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      { "x_axis": -161.80339887498945 + (width/2), "y_axis": 117.55705045849464 + (height/2)  , "radius": 30, "color" : "rgb(0, 148, 255)"},
      { "x_axis": -200 + (width/2), "y_axis": 0 + (height/2), "radius": 20, "color" : "red"},
      { "x_axis": -161.80339887498948 + (width/2), "y_axis": -117.5570504584946 + (height/2), "radius": 20, "color" : "red"},
      { "x_axis": -61.80339887498951 + (width/2), "y_axis": -190.2113032590307 + (height/2), "radius": 20, "color" : "rgb(207, 207, 207)"},
      { "x_axis": 61.80339887498945 + (width/2), "y_axis": -190.21130325903073 + (height/2), "radius": 30, "color" : "rgb(0, 148, 255)"},
      { "x_axis": 161.80339887498945 + (width/2), "y_axis": -117.55705045849467 + (height/2), "radius": 20, "color" : "red"},
    ];

    var jsonLine = [
      { "x1": 200 + (width/2), "y1": 0 + (height/2), "x2": 161.80339887498948  + (height/2) , "y2":117.55705045849463 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" },
      { "x1": 161.80339887498948  + (height/2), "y1": 117.55705045849463 + (height/2), "x2":  61.80339887498949 + (width/2), "y2": 190.2113032590307 + (height/2), "stroke_width": 5, "stroke" : "rgb(78, 78, 78)" }
    ];



    var svgContainer = d3.select("svg")
    var group = svgContainer.append("g")

    jsonCircles.forEach(i=>{
      console.log(i);
      var circles = group.append("circle")
                                .attr("cx", i.x_axis)
                                .attr("cy", i.y_axis)
                                .attr("r", i.radius)
                                .style("fill", i.color);
    })


    jsonLine.forEach(i=>{
      var line = group.append("line")
                                .attr("x1", i.x1)
                                .attr("y1", i.y1)
                                .attr("x2", i.x2)
                                .attr("y2", i.y2)
                                .attr("stroke-width", i.stroke_width)
                                .attr("stroke", i.stroke);
    })



    var curAngle = 0;
    var interval = null;

    group.call(d3.drag().on('drag', dragged));

    function dragged() {
                var r = {
                    x: d3.event.y,
                    y: d3.event.x
                };
                group.attr("transform","rotate(" + r.x + "," + origin.x + "," + origin.y + ")" );
            };


    // function goRotate() {
    //   curAngle += 1;
    //   group.attr("transform", "translate(" + width / 2 + "," + height / 2 + ") rotate(" + curAngle + "," + 0 + "," + 0 + ")");
    // }
    // var circleAttributes = circles
    //                        .attr("cx", function (d) { return d.x_axis; })
    //                        .attr("cy", function (d) { return d.y_axis; })
    //                        .attr("r", function (d) { return d.radius; })
    //                        .style("fill", function(d) { return d.color; });

    // svgContainer.append("g")
    //             .selectAll("g")
    //             .data(jsonCircles)
    //             .enter()
    //             .append("circle");

    // d3.selectAll("div")
    //   .on("mouseover", function(){
    //       d3.select(this)
    //         .style("background-color", "orange");
    //
    //       // Get current event info
    //       console.log(d3.event);
    //
    //       // Get x & y co-ordinates
    //       console.log(d3.mouse(this));
    //   })
    //   .on("mouseout", function(){
    //       d3.select(this)
    //         .style("background-color", "steelblue")
    //   });


  </script>
</html>
