google.load("visualization", "1", {
	packages : [ "corechart" ]
});

google.setOnLoadCallback(drawNewShopsChart);

/* New Shops Chart */
function drawNewShopsChart() {
	var thisYear = new Date().getFullYear();
	var stores = getNewStores(thisYear)["stores"];
	var table = [ [ 'Month', 'Shops' ],
	  			  [ 'Jan.', 0 ], 
	  			  [ 'Feb.', 0 ], 
	  			  [ 'Mar.', 0 ],
				  [ 'Apr.', 0 ], 
				  [ 'May', 0 ], 
				  [ 'Jun.', 0 ],
				  [ 'Jul.', 0 ], 
				  [ 'Aug.', 0 ], 
				  [ 'Sep.', 0 ],
				  [ 'Oct.', 0 ],];
	
	for (var i=0; i < stores.length; i++){
		var month = parseInt(stores[i]["month"]);
		var total = parseInt(stores[i]["total"]);
		table[month][1] = total;
		
	}
	var data = google.visualization.arrayToDataTable(table);

	var options = {
		title : 'Year 2013',
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

/**
 * Get stores by months
 */
function getNewStores(year) {
	$.ajaxSetup({
		"async" : false
	});
	var data = $.getJSON("../ajax/plataform/getNewStoresByMonths.php?", {
		year : year
	});
	$.ajaxSetup({
		"async" : true
	});
	return $.parseJSON(data["responseText"]);
}

