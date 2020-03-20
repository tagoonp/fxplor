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
    <!-- <svg width="600" height="500" ></svg> -->
  </body>

  <script src="https://d3js.org/d3.v4.min.js"></script>
  <script type="text/javascript">

    var point = 10
    var outcome = 3
    var radious = 200
    var point_outcome = parseInt(point/outcome)
    console.log(point_outcome);
    var eachdegree = 360/point;
    var startPoint = 0 - eachdegree;

    var x1 = 0, y1 = 0, x2 = 0, y2 = 0;
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

    var jsonCircles = [
    { "x_axis": 200 + (width/2), "y_axis": 0 + (height/2), "radius": 22, "color" : "green" },
    { "x_axis": 161.80339887498948 + (width/2), "y_axis": 117.55705045849463 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": 61.80339887498949 + (width/2), "y_axis": 190.2113032590307 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": -61.80339887498947 + (width/2), "y_axis": 190.21130325903073 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": -161.80339887498945 + (width/2), "y_axis": 117.55705045849464 + (height/2)  , "radius": 22, "color" : "green"},
    { "x_axis": -200 + (width/2), "y_axis": 0 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": -161.80339887498948 + (width/2), "y_axis": -117.5570504584946 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": -61.80339887498951 + (width/2), "y_axis": -190.2113032590307 + (height/2), "radius": 15, "color" : "red"},
    { "x_axis": 61.80339887498945 + (width/2), "y_axis": -190.21130325903073 + (height/2), "radius": 22, "color" : "green"},
    { "x_axis": 161.80339887498945 + (width/2), "y_axis": -117.55705045849467 + (height/2), "radius": 15, "color" : "red"},
  ];



    var svgContainer = d3.select("body").append("svg")
                                        .attr("width", width)
                                        .attr("height", height);

    // var svgContainer = d3.create("svg")
    //   .attr("viewBox", [-width / 2, -height / 2, width, height]);

    var circles = svgContainer.selectAll("circle")
                              .data(jsonCircles)
                              .enter()
                              .append("circle");

    var circleAttributes = circles
                           .attr("cx", function (d) { return d.x_axis; })
                           .attr("cy", function (d) { return d.y_axis; })
                           .attr("r", function (d) { return d.radius; })
                           .style("fill", function(d) { return d.color; });

    // svgContainer.append("g")
    //             .selectAll("g")
    //             .data(jsonCircles)
    //             .enter()
    //             .append("circle");

    d3.selectAll("div")
      .on("mouseover", function(){
          d3.select(this)
            .style("background-color", "orange");

          // Get current event info
          console.log(d3.event);

          // Get x & y co-ordinates
          console.log(d3.mouse(this));
      })
      .on("mouseout", function(){
          d3.select(this)
            .style("background-color", "steelblue")
      });


  </script>
</html>
