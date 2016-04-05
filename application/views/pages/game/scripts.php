<script src="/assets/js/Chart.js"></script>
<script>
var ctx = document.getElementById("myChart");
var data = {
    // This needs to be changed and loaded in
    labels: [{stockname}],
	datasets: [{
			label: "Stocks",

			// The properties below allow an array to be specified to change the value of the item at the given index
			// String  or array - the bar color
			backgroundColor: "rgba(255,102,0,1)",

			// String or array - bar stroke color
			borderColor: "rgba(220,220,220,1)",

			// Number or array - bar border width
			borderWidth: 1,

			// String or array - fill color when hovered
			hoverBackgroundColor: "rgba(0,0,0,0.2)",

			// String or array - border color when hovered
			hoverBorderColor: "rgba(255,153,0,1)",

			// The actual data
            // this needs to be loaded in
			data: [{stockvalue}],

			// String - If specified, binds the dataset to a certain y-axis. If not specified, the first y-axis is used.
			yAxisID: "y-axis-0",
    }]
};
var options = {
    responsive: false, // response to the browser being changed
    legend: {
        display: false
    },
    scales: {
        xAxes: [{
            stacked: true,
        }],
        yAxes: [{
            ticks: {
                beginAtZero: true,
                max: 200,
                min: -200
            },
        }],
    }
};
var myChart = new Chart(ctx, {
		type: 'bar',
		data: data,
		options: options
});
setInterval(update, 8000);

function update()
{
    for(i = 0; i < 6; i++)
        myChart.data.datasets[0].data[i] = Math.random() * (201 - -200) +  -200;
    myChart.update();
}
</script>
