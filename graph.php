<?php
/**
 * Created by PhpStorm.
 * User: romerov
 * Date: 7/6/2015
 * Time: 1:04 PM
 */
?>
<!DOCTYPE html>
<html lang="en-US" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8"/>
</head>
<script type="text/javascript" src="js/jquery1.10.2.js"></script>
<script type="text/javascript" src="js/d3.min.js"></script>
<script type="text/javascript" src="js/d3-tip.js"></script>

<script type="text/javascript">
    $(document).ready(function() {



        function drawGraph(year){
// Bring the new data
            var dataset = [{"year":"2014","month":"1","order_dt":"2014-01-05","center":"JAX","total":"34"},{"year":"2014","month":"2","order_dt":"2014-02-03","center":"JAX","total":"36"},{"year":"2014","month":"3","order_dt":"2014-03-03","center":"JAX","total":"45"},{"year":"2014","month":"4","order_dt":"2014-04-01","center":"JAX","total":"38"},{"year":"2014","month":"5","order_dt":"2014-05-01","center":"JAX","total":"41"},{"year":"2014","month":"6","order_dt":"2014-06-02","center":"JAX","total":"47"},{"year":"2014","month":"7","order_dt":"2014-07-02","center":"JAX","total":"42"},{"year":"2014","month":"8","order_dt":"2014-08-01","center":"JAX","total":"34"},{"year":"2014","month":"9","order_dt":"2014-09-03","center":"JAX","total":"41"},{"year":"2014","month":"10","order_dt":"2014-10-03","center":"JAX","total":"37"},{"year":"2014","month":"11","order_dt":"2014-11-02","center":"JAX","total":"38"},{"year":"2014","month":"12","order_dt":"2014-12-01","center":"JAX","total":"37"},{"year":"2014","month":"1","order_dt":"2014-01-07","center":"MU","total":"11"},{"year":"2014","month":"2","order_dt":"2014-02-13","center":"MU","total":"5"},{"year":"2014","month":"3","order_dt":"2014-03-13","center":"MU","total":"7"},{"year":"2014","month":"4","order_dt":"2014-04-01","center":"MU","total":"7"},{"year":"2014","month":"5","order_dt":"2014-05-05","center":"MU","total":"12"},{"year":"2014","month":"6","order_dt":"2014-06-02","center":"MU","total":"16"},{"year":"2014","month":"7","order_dt":"2014-07-02","center":"MU","total":"12"},{"year":"2014","month":"8","order_dt":"2014-08-07","center":"MU","total":"7"},{"year":"2014","month":"9","order_dt":"2014-09-02","center":"MU","total":"7"},{"year":"2014","month":"10","order_dt":"2014-10-13","center":"MU","total":"3"},{"year":"2014","month":"11","order_dt":"2014-11-03","center":"MU","total":"5"},{"year":"2014","month":"12","order_dt":"2014-12-11","center":"MU","total":"7"},{"year":"2014","month":"1","order_dt":"2014-01-02","center":"UCD","total":"57"},{"year":"2014","month":"2","order_dt":"2014-02-03","center":"UCD","total":"38"},{"year":"2014","month":"3","order_dt":"2014-03-02","center":"UCD","total":"41"},{"year":"2014","month":"4","order_dt":"2014-04-01","center":"UCD","total":"53"},{"year":"2014","month":"5","order_dt":"2014-05-01","center":"UCD","total":"37"},{"year":"2014","month":"6","order_dt":"2014-06-02","center":"UCD","total":"56"},{"year":"2014","month":"7","order_dt":"2014-07-01","center":"UCD","total":"32"},{"year":"2014","month":"8","order_dt":"2014-08-01","center":"UCD","total":"47"},{"year":"2014","month":"9","order_dt":"2014-09-02","center":"UCD","total":"35"},{"year":"2014","month":"10","order_dt":"2014-10-01","center":"UCD","total":"45"},{"year":"2014","month":"11","order_dt":"2014-11-03","center":"UCD","total":"41"},{"year":"2014","month":"12","order_dt":"2014-12-02","center":"UCD","total":"39"},{"year":"2014","month":"1","order_dt":"2014-01-08","center":"UNC","total":"9"},{"year":"2014","month":"2","order_dt":"2014-02-03","center":"UNC","total":"9"},{"year":"2014","month":"3","order_dt":"2014-03-03","center":"UNC","total":"18"},{"year":"2014","month":"4","order_dt":"2014-04-01","center":"UNC","total":"13"},{"year":"2014","month":"5","order_dt":"2014-05-05","center":"UNC","total":"7"},{"year":"2014","month":"6","order_dt":"2014-06-04","center":"UNC","total":"9"},{"year":"2014","month":"7","order_dt":"2014-07-07","center":"UNC","total":"12"},{"year":"2014","month":"8","order_dt":"2014-08-18","center":"UNC","total":"11"},{"year":"2014","month":"9","order_dt":"2014-09-03","center":"UNC","total":"9"},{"year":"2014","month":"10","order_dt":"2014-10-20","center":"UNC","total":"4"},{"year":"2014","month":"11","order_dt":"2014-11-05","center":"UNC","total":"5"},{"year":"2014","month":"12","order_dt":"2014-12-02","center":"UNC","total":"7"}];
            maxValue = d3.max(dataset,function(d){return +d.total;});
//            console.log(maxValue);

            yScale = d3.scale.linear()
                .domain ([0,maxValue]).nice()
                .range([h,margin]);

            yAxis.scale(yScale);

            svg.select(".y.axis")
                .transition()
                .duration(duration)
                .call(yAxis);

// Updates the grid
            var grid = svg.selectAll("line.horizontalGrid")
                .data(yScale.ticks());

            grid.transition()
                .duration(duration)
                .attr(
                {
                    "y1" : function(d){ return yScale(d);},
                    "y2" : function(d){ return yScale(d);}
                });

            grid.enter()
                .append("line")
                .attr(
                {
                    "class":"horizontalGrid",
                    "x1" : margin,
                    "y1" : margin,
                    "x2" : w-margin,
                    "y2" : margin,
                    "fill" : "none",
                    "shape-rendering" : "crispEdges",
                    "stroke" : "lightgrey",
                    "opacity": "0.7",
                    "stroke-width" : "1px"
                });

            grid.transition()
                .duration(duration)
                .attr(
                {
                    "x1" : margin,
                    "x2" : w-margin,
                    "y1" : function(d){ return yScale(d);},
                    "y2" : function(d){ return yScale(d);}
                });

            grid.exit().remove();

// Nest the data by centers into an array
            var centerGroup = d3.nest()
                .key(function(d){return d.center;})
                .entries(dataset);
//            console.log(centerGroup);

            // UPDATE LINES
// Remove existing lines
            d3.selectAll(".line")
                .remove();

// Update lines
            centerGroup.forEach(function(d,i){
                svg.append("path")
                    .datum(d.values)
                    .attr("opacity",0)
                    .transition()
                    .duration(duration*3)
                    .attr("d",line)
                    .attr("class" , "line center_"+d.values[i].center)
                    .style("stroke",color(d.values[i].center))
                    .attr("opacity",1);
            });


// UPDATE DOTS
// Remove existing dots
           d3.selectAll(".dot")
                .transition().duration(duration)
                .attr("cy",h)
                .attr("opacity",0.5)
                .remove();

// Draw the new dots
            var dots = svg.selectAll(".dot")
                    .data(dataset);

            dots.exit()
                .transition()
                .duration(duration)
                .attr({
                    "cx" : function(d) { return xScale(d.month);},
                    "cy" : h,
                    "opacity" : 0
                })
                .remove();

            dots.enter()
                .append("circle")
                .attr({
                    "class" : function(d){return "dot center_"+d.center;},
                    "cx" : function(d){return xScale(d.month)},
                    "cy" : h,
                    "r" : 5,
                    "fill" : function(d){return color(d.center);},
                    "opacity" : 0.5
                })
                .on('mouseover', tooltip.show)
                .on('mouseout', tooltip.hide);
//                .on('mouseover', function(){d3.select(this).attr("r",8)})
//                .on('mouseout',function(){d3.select(this).attr("r",5)});

            dots.transition()
                .duration(duration)
                .attr({
                    "class" : function(d){ return "dot center_"+d.center;},
                    "cx" : function(d) { return xScale(d.month);},
                    "cy" : function(d) { return yScale(d.total); },
                     "fill" : function(d){return color(d.center);},
                    "opacity" : 1
                });




//            console.log(centerGroup);

// UPDATE LEGENDS
// Rectangles of the legend

            var centers = [{"center":"JAX"},{"center":"MU"},{"center":"UCD"},{"center":"UNC"}];
            var rect = legend.selectAll(".legendRect")
                .data(centers);

            rect.exit()
                .transition()
                .duration(duration)
                .attr({
                    "y" : 0,
                    "opacity" : 0
                })
                .remove();


            rect.enter()
                .append("rect")
                .attr({
                    "width": rectSize,
                    "height" : rectSize,
                    "y" : 0,
                    "fill" : function(d){return color(d.center)},
                    "opacity" : 0,
                    "class" : "legendRect",
                    "center" : function(d){ return d.center;}
                });

            rect.transition()
                .duration(duration)
                .attr({
                    "opacity" : 1,
                    "fill-opacity" : 1,
                    "y" : function(d,i){return margin/2*i;},
                    "fill" : function(d){return color(d.center)},
                    "stroke" : function(d){return color(d.center)},
                    "center" : function(d){ return d.center;}
                });


            var opacityDown = 0;
            d3.selectAll(".legendRect")
                .on("click",(function(){
                var center = d3.select(this).attr("center");

                var dots = svg.selectAll(".center_"+center);
                    dots.
                        transition()
                        .duration(duration)
                        .attr("opacity",function(){
                        if(d3.select(this).attr("opacity")== opacityDown){
                            return 1;
                        }else{
                            return opacityDown;
                    }
                    });

                    d3.select(this)
                        .transition()
                        .duration(duration)
                        .attr("fill-opacity",function() {
                            if (d3.select(this).attr("fill-opacity") == opacityDown) {
                                return 1;
                            } else {
                                return opacityDown;
                            }
                        })
            }));



// Text of the  legend

           var legendText = legend.selectAll(".legendText")
                .data(centers);

            legendText.enter()
                .append("text")
                .text(function(d) { return d.center; })
                .attr({
                    "opacity" : 0,
                    "x" : rectSize+(rectSize/2),
                    "y" : 0,
                    "class" : "legendText"
                });

            legendText
                .transition()
                .duration(duration)
                .text(function(d) { return d.center; })
                .attr({
                    "y" : function(d,i){return (margin/2*i)+rectSize-2},
                    "opacity" : 1
                     });

            legendText.exit()
                .transition()
                .duration(duration)
                .attr({
                    "y" : 0,
                    "opacity" : 0
                })
                .remove();




  }
// . END DRAW FUNCTION


        $("#select_year").on("change",function(){
            var year = $(this).val();
            drawGraph(year);

        });


        var years = [{"year":"2015"},{"year":"2014"},{"year":"2013"},{"year":"2012"}];

        years.forEach(function(d){
            $("#select_year")
                .append("<option value='"+d.year+"'>"+d.year+"</option>");
        });


// Initilyze the max value for y axis
        var maxValue = 100;
        var w = 640;
        var h = 400;
        var margin = 40;
        var month_names_short = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

        var duration=300;

    var svg = d3.select("body")
        .append("svg")
        .attr("width",w+margin)
        .attr("height", h+margin)
        .style("border","solid lightgrey 1px");

        d3.select("svg").append("rect")
            .attr({
                "x": margin,
                "y": margin,
                "width" : w-margin*2,
                "height" : h-margin,
                "fill" : "#FFFFFF"
            });

    var color = d3.scale.category10();
    var xScale = d3.scale.linear()
        .domain([1,12])
        .range([margin, w-margin]);

    var yScale = d3.scale.linear()
        .domain ([0,maxValue])
        .range([h,margin]);

    var monthScale = d3.scale.ordinal()
        .domain(month_names_short)
        .rangePoints([margin, w-margin]);

    var xAxis = d3.svg.axis()
        .scale(monthScale)
        .orient("bottom")
        .tickSize(4);

    var yAxis = d3.svg.axis()
        .scale(yScale)
        .orient("left")
        .tickSize(4);

    svg.append("g")
        .attr("class","x axis")
        .attr("transform","translate(0,"+h+")")
        .call(xAxis);

    svg.append("g")
        .attr("class","y axis")
        .attr("transform","translate("+margin+",0)")
        .call(yAxis);

// Creates the grid
    svg.selectAll("line.verticalGrid")
        .data(xScale.ticks(12))
        .enter()
        .append("line")
        .attr(
        {
            "class":"verticalGrid",
            "x1" : function(d){ return xScale(d);},
            "x2" : function(d){ return xScale(d);},
            "y1" : margin,
            "y2" : h,
            "fill" : "none",
            "shape-rendering" : "crispEdges",
            "stroke" : "lightgrey",
            "opacity": "0.7",
            "stroke-width" : "1px"
        });

    svg.selectAll("line.horizontalGrid")
        .data(yScale.ticks())
        .enter()
        .append("line")
        .attr(
        {
            "class":"horizontalGrid",
            "x1" : margin,
            "x2" : w-margin,
            "y1" : function(d){ return yScale(d);},
            "y2" : function(d){ return yScale(d);},
            "fill" : "none",
            "shape-rendering" : "crispEdges",
            "stroke" : "lightgrey",
            "opacity": "0.7",
            "stroke-width" : "1px"
        });

        var line = d3.svg.line()
            .x(function(d){return xScale(d.month);})
            .y(function(d){return yScale(d.total);});

        var rectSize = 14;
        var legend = svg.append("g")
            .attr({
                "x" : margin,
                "y" : margin,
                "class" : "legend"
            })
            .attr("transform", "translate("+(w-margin+rectSize)+","+margin+")");

// Tooltip
        var tooltip = d3.tip()
            .attr('id', 'tooltip')
            .offset([-10, 0])
            .html(function(d) {
                return "<small>Total Orders</small>\n<strong>" + d.total+ "</strong>";
            });
        svg.call(tooltip);


 drawGraph();




})

</script>

    <style>

        .axis path,
        .axis line{

            fill: none;
            stroke: black;
            shape-rendering: crispEdges;
        }

        .axis text{
            font-family: Arial, Geneva, sans-serif;
            font-size: 11px;
            font-weight: normal;
        }

        .axis.x2 text,
        .axis.x text{
            font-weight: bold;
        }


        .line{
            fill: none;
            stroke-width: 2px;
        }
        .legendRect{
            stroke-width:1;

        }

        .legendText{
            font-family: Arial, Geneva, sans-serif;
            font-size: 12px;
            font-weight: normal;
        }

        #tooltip {
            position: absolute;
            width: 90px;
            height: auto;
            padding: 8px;
            border; solid 1px grey;
            background-color: white;
            -webkit-border-radius: 8px;
            -moz-border-radius: 8px;
            border-radius: 8px;
            -webkit-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.4);
            -moz-box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.4);
            box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.4);
            pointer-events: none;
            font-family: sans-serif;
            font-size: 14px;
            text-align: center;
        }

        .dot,
        .dotsByYear,
        .legendRect,
        .legendRectYears{
            cursor: pointer;
        }

        svg{
            background: -webkit-linear-gradient(#FFFFFF, #F9F9F9); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(#FFFFFF, #F9F9F9); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(#FFFFFF, #F9F9F9); /* For Firefox 3.6 to 15 */
            background: linear-gradient(#FFFFFF, #F9F9F9); /* Standard syntax */
        }
    </style>

    <body>
    <div class="row">
    <form class="form-horizontal">

    <div class="form-group">
        <label class="col-md-4 control-label" for="select_year"></label>
        <div class="col-md-5">
            <select id="select_year" name="select_year" class="form-control">

            </select>
        </div>
    </div>
    </form>
        </div>

    <div class="row" id="chart">
    </div>


    </body>
</html>