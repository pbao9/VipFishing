@push('libs-js')
    <!-- Resources -->
    <script src="https://cdn.amcharts.com/lib/5/index.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
    <script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
    <script src="//cdn.amcharts.com/lib/5/themes/Responsive.js"></script>
@endpush
@push('custom-js')
<script>
    function makeAmchart(elm, crawData, labelName, valueY) {
        // Create root element
        // https://www.amcharts.com/docs/v5/getting-started/#Root_element
        var root = am5.Root.new(elm);
        
        //remove logo amcharts
        root._logo.dispose();

        // Set themes
        // https://www.amcharts.com/docs/v5/concepts/themes/
        root.setThemes([
            am5themes_Animated.new(root)
        ]);

        // Create chart
        // https://www.amcharts.com/docs/v5/charts/xy-chart/
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: true,
            panY: true,
            wheelX: "panX",
            wheelY: "zoomX"
        }));

        // Add cursor
        // https://www.amcharts.com/docs/v5/charts/xy-chart/cursor/
        var cursor = chart.set("cursor", am5xy.XYCursor.new(root, {
            xAxis: xAxis
        }));
        cursor.lineY.set("visible", false);

        // Create axes
        // https://www.amcharts.com/docs/v5/charts/xy-chart/axes/
        var xRenderer = am5xy.AxisRendererX.new(root, {
            minGridDistance: 30
        });
        xRenderer.labels.template.setAll({
            rotation: -45,
            centerY: am5.p50,
            fontSize: 10
        });
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            maxDeviation: 0,
            categoryField: labelName,
            renderer: xRenderer,
            tooltip: am5.Tooltip.new(root, {})
        }));

        xRenderer.grid.template.set("visible", false);

        var yRenderer = am5xy.AxisRendererY.new(root, {});
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            maxDeviation: 0,
            min: 0,
            extraMax: 0,
            renderer: yRenderer
        }));

        yRenderer.grid.template.setAll({
            strokeDasharray: [2, 2]
        });


        // Create series
        // https://www.amcharts.com/docs/v5/charts/xy-chart/series/
        var series = chart.series.push(am5xy.ColumnSeries.new(root, {
            name: "Statistic Chart",
            xAxis: xAxis,
            yAxis: yAxis,
            valueYField: valueY,
            valueXField: labelName,
            fill: am5.color(0x660087),
            stroke: am5.color(0x660087),
            sequencedInterpolation: true,
            categoryXField: labelName,
            tooltip: am5.Tooltip.new(root, {
                dy: 0,
                labelText: "{valueY}"
            })
        }));


        series.columns.template.setAll({
            cornerRadiusTL: 5,
            cornerRadiusTR: 5,
            strokeWidth: 2,
            // strokeOpacity: 0,
            // fillOpacity: 0.5
        });
        series.columns.template.set("fillGradient", am5.LinearGradient.new(root, {
            stops: [{
                opacity: 1
            }, {
                opacity: 0.6
            }],
            rotation: 90
        }));
        
        // series.columns.template.adapters.add("fill", (fill, target) => {
        //     return chart.get("colors").getIndex(series.columns.indexOf(target));
        // });

        // series.columns.template.adapters.add("stroke", (stroke, target) => {
        //     return chart.get("colors").getIndex(series.columns.indexOf(target));
        // });

        // Set data
        var data = JSON.parse(crawData);

        xAxis.data.setAll(data);
        series.data.setAll(data);

        // Make stuff animate on load
        // https://www.amcharts.com/docs/v5/concepts/animations/
        series.appear(1000);
        chart.appear(1000, 100);
    }
    
</script>
@endpush