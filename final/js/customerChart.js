google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);
var options;
function drawChart(){
	
	var data = new google.visualization.DataTable();
      data.addColumn('string', 'Category');
      data.addColumn('number', 'Count');
	  for(var i=0;i<categories.length;i++){
		  data.addRows([[categories[i], parseInt(count[i])]]);
	  }
      var options = {'title':'Customers based on Frequent status',
                     'width':500,
                     'height':500,
					 is3D: true};

      var chart = new google.visualization.PieChart(document.getElementById('customerChart_div'));
      chart.draw(data, options);

	 
}
function drawCustomerChart(){
	drawChart();
}