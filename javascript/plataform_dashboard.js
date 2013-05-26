google.load("visualization", "1", {
	packages : [ "corechart" ]
});

google.setOnLoadCallback(drawNewShopsChart);


/* New Shops Chart */
function drawNewShopsChart() {
	var data = google.visualization
			.arrayToDataTable([ [ 'Month', 'Shops' ],
					[ 'Jan.', 1 ], [ 'Feb.', 1170 ],
					[ 'Mar.', 1170 ], [ 'Apr.', 1030],
					[ 'May', 1170 ], [ 'Jun.', 1030],
					[ 'Jul.', 1170 ], [ 'Aug.', 1030],
					[ 'Sep.', 1170 ], [ 'Oct.', 1030],
					]);

	var options = {
			 title: 'Year 2013',
		hAxis : {
			title : 'Month',
			titleTextStyle : {
				color : 'orange'
			}
		}
	};

	var chart = new google.visualization.ColumnChart(document
			.getElementById('chart_newShops'));
	chart.draw(data, options);
}