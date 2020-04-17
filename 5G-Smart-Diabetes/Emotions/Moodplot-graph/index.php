<!DOCTYPE html>
<html >
  <head>
      <link rel="icon"
            type="image/png"
            href="css/favicon.png">
    <meta charset="UTF-8">
    <title>Intelligent Graph</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <style>

    </style>

      <script src="js/prefixfree.min.js"></script>
      <script type="text/javascript" src="graph/js/fusioncharts.js"></script>
      <script type="text/javascript" src="graph/js/themes/fusioncharts.theme.fint.js"></script>

      <?php
      $myfile="graph/data.txt";
      $data=file($myfile);

      $file_handle = fopen("graph/data.txt", "rb");
      $dataInJson = array();
      $totalElement =0;
      foreach($data as $line)
      {
          $str=preg_replace("/(^[\r\n]*|[\r\n\t]+)[\s\t]*[\r\n\t]+/", "", $line); //to remove \n,\t,\r
          $var = explode('	',$str);
//		$arr[$var[0]] = $var[1];
          $element= array('label'=>$var[0],'value'=>$var[1]);
          $dataInJson[$totalElement++]=$element;
      }

      $output = json_encode($dataInJson);
      //var_dump($dataInJson);

      ?>

      <script type="text/javascript">
        function getLineGraph() {
            FusionCharts.ready(function () {
                var revenueChart = new FusionCharts({
                    "type": "line",
                    "renderAt": "chartContainerLineGrpah",
                    "width": "1030",
                    "height": "400",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                            "caption":"Sentiment Analysis of Big Data",
                            "subCaption": "Based on data from Twitter",
                            "yAxisName": "No of tweets",
			    "xAxisName":"Emotion Type",
                            "lineThickness": "2",
                            "paletteColors": "#0075c2",
                            "baseFontColor": "#333333",
                            "baseFont": "Helvetica Neue,Arial",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "showBorder": "0",
                            "bgColor": "#ffffff",
                            "showShadow": "0",
                            "canvasBgColor": "#ffffff",
                            "canvasBorderAlpha": "0",
                            "divlineAlpha": "100",
                            "divlineColor": "#999999",
                            "divlineThickness": "1",
                            "divLineDashed": "1",
                            "divLineDashLen": "1",
                            "divLineGapLen": "1",
                            "showXAxisLine": "1",
                            "xAxisLineThickness": "1",
                            "xAxisLineColor": "#999999",
                            "showAlternateHGridColor": "0"
                        },
                        "data": <?php echo $output;?>
                    }

                });
                revenueChart.render();
            })
        }

          function getBarGraph(){
              FusionCharts.ready(function () {
                  var revenueChart = new FusionCharts({
                      "type": "column3d",
                      "renderAt": "chartContainerBarGraph",
                      "width": "1030",
                      "height": "400",
                      "dataFormat": "json",
                      "dataSource": {
                          "chart": {
                           "caption":"Sentiment Analysis of Big Data",
                            "subCaption": "Based on data from Twitter",
                            "yAxisName": "No of tweets",
			    "xAxisName":"Emotion Type",
                              "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000,#cc66ff",
                              "bgColor": "#ffffff",
                              "showBorder": "0",
                              "use3DLighting": "0",
                              "showShadow": "0",
                              "enableSmartLabels": "0",
                              "startingAngle": "0",
                              "showPercentValues": "1",
                              "showPercentInTooltip": "0",
                              "decimals": "1",
                              "captionFontSize": "14",
                              "subcaptionFontSize": "14",
                              "subcaptionFontBold": "0",
                              "toolTipColor": "#ffffff",
                              "toolTipBorderThickness": "0",
                              "toolTipBgColor": "#000000",
                              "toolTipBgAlpha": "80",
                              "toolTipBorderRadius": "2",
                              "toolTipPadding": "5",
                              "showHoverEffect": "1",
                              "showLegend": "1",
                              "legendBgColor": "#ffffff",
                              "legendBorderAlpha": "0",
                              "legendShadow": "0",
                              "legendItemFontSize": "10",
                              "legendItemFontColor": "#666666",
                              "useDataPlotColorForLabels": "1"
                          },
                          "data": <?php echo $output;?>
                      }

                  });
                  revenueChart.render();
              })


          }

        function getPieGraph(){
            FusionCharts.ready(function () {
                var revenueChart = new FusionCharts({
                    "type": "pie3d",
                    "renderAt": "chartContainerPieGraph",
                    "width": "1030",
                    "height": "400",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                           "caption":"Sentiment Analysis of Big Data",
                            "subCaption": "Based on data from Twitter",                        
                    
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000,#cc66ff",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "0",
                            "showPercentValues": "1",
                            "showPercentInTooltip": "0",
                            "decimals": "1",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "toolTipColor": "#ffffff",
                            "toolTipBorderThickness": "0",
                            "toolTipBgColor": "#000000",
                            "toolTipBgAlpha": "80",
                            "toolTipBorderRadius": "2",
                            "toolTipPadding": "5",
                            "showHoverEffect": "1",
                            "showLegend": "1",
                            "legendBgColor": "#ffffff",
                            "legendBorderAlpha": "0",
                            "legendShadow": "0",
                            "legendItemFontSize": "10",
                            "legendItemFontColor": "#666666",
                            "useDataPlotColorForLabels": "1"
                        },
                        "data": <?php echo $output;?>
                    }

                });
                revenueChart.render();
            })


        }
        function getDoughnutGraph(){
            FusionCharts.ready(function () {
                var revenueChart = new FusionCharts({
                    "type": "doughnut3d",
                    "renderAt": "chartContainerDoughnutGraph",
                    "width": "1030",
                    "height": "400",
                    "dataFormat": "json",
                    "dataSource": {
                        "chart": {
                                  "caption":"Sentiment Analysis of Big Data",
                            "subCaption": "Based on data from Twitter",
                            
                            "paletteColors": "#0075c2,#1aaf5d,#f2c500,#f45b00,#8e0000,#cc66ff",
                            "bgColor": "#ffffff",
                            "showBorder": "0",
                            "use3DLighting": "0",
                            "showShadow": "0",
                            "enableSmartLabels": "0",
                            "startingAngle": "0",
                            "showPercentValues": "1",
                            "showPercentInTooltip": "0",
                            "decimals": "1",
                            "captionFontSize": "14",
                            "subcaptionFontSize": "14",
                            "subcaptionFontBold": "0",
                            "toolTipColor": "#ffffff",
                            "toolTipBorderThickness": "0",
                            "toolTipBgColor": "#000000",
                            "toolTipBgAlpha": "80",
                            "toolTipBorderRadius": "2",
                            "toolTipPadding": "5",
                            "showHoverEffect": "1",
                            "showLegend": "1",
                            "legendBgColor": "#ffffff",
                            "legendBorderAlpha": "0",
                            "legendShadow": "0",
                            "legendItemFontSize": "10",
                            "legendItemFontColor": "#666666",
                            "useDataPlotColorForLabels": "1"
                        },
                        "data": <?php echo $output;?>
                    }

                });
                revenueChart.render();
            })


        }

      </script>



      

    
  </head>

  <body>

    <section>
        <input type="radio" id="homeDetail" value="0" name="tractor" checked='checked' />
        <input type="radio" id="barGraph" value="1" name="tractor" />
        <input type="radio" id="lineGraph" value="2" name="tractor" />
        <input type="radio" id="pieGraph" value="3" name="tractor" />
        <input type="radio" id="doughnutGraph" value="4" name="tractor" />


      <nav>

          <label for="homeDetail" class='fontawesome-home'></label>
          <label for="lineGraph" class='labelCss' onclick="getLineGraph()"> Line</label>
          <label for="barGraph" class='labelCss' onclick="getBarGraph()">3D Bar</label>
          <label for="pieGraph" class='labelCss' onclick="getPieGraph()">3D Pie</label>
          <label for="doughnutGraph" class='labelCss' onclick="getDoughnutGraph()">3D D"hnut</label>
      </nav>
        <article class="homeDetail">
            <h1 class="homePage">Welcome To Intelligent Graph</h1>
        </article>
        <article class='lineGraph'>

            <div id="chartContainerLineGrpah" >Graph will load here! Watchout....</div>


        </article>

        <article class='barGraph'>
          <div id="chartContainerBarGraph" >Graph will load here! Watchout....</div>

      </article>
        <article class='pieGraph'>
          <div id="chartContainerPieGraph" >Graph will load here! Watchout....</div>

      </article>
        <article class='doughnutGraph'>
          <div id="chartContainerDoughnutGraph" >Graph will load here! Watchout....</div>

      </article>


    </section>

    
        <script src="js/index.js"></script>

    
    
    
  </body>
</html>
