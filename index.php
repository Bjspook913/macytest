<?php ?>


<!DOCTYPE HTML>
<html>
<head>
<title>Macy Test</title>
<script type = "text/javascript" 
    src = "http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <link href="style.css" rel="stylesheet" type="text/css" media="screen, projection" />
</head>



<script src="Chart.js/dist/Chart.js"></script>


<body>

<section id="body_container"></section>


<canvas id="myChart" width="200" height="200"></canvas>

</body>


<script type = "text/javascript" language = "javascript">
        $(document).ready(function() {

        	var ctx = document.getElementById("myChart");

			var $htmlname = [];
			var $wordnum = [];
	        $.ajax({
			    url: 'http://localhost:88/macytest/assessment/test_feed.json',
			    type: 'GET',
			    dataType: 'json',
			    success: function(response){
			    var htmltext = [];
			    	console.log(response);
			        for(var i in response.content)
					{
					     $htmlname.push(response.content[i].content.authorId);
					     htmltext+='<div class="bodytext">'+response.content[i].content.bodyHtml+'</div>';
					}

				document.getElementById('body_container').innerHTML+= htmltext;

				var items = document.getElementsByClassName('bodytext');
				for (var i = 0; i < items.length; i++){
					var word_count = items[i].textContent.split(' ').length;
					
					$wordnum.push(word_count);
				}

				var myChart = new Chart(ctx, {
				    type: "radar",
				    data: data = {
					    labels: $htmlname,
					    datasets: [
					        {
					            label: '# of words',
					            backgroundColor: "rgba(179,181,198,0.2)",
					            borderColor: "rgba(179,181,198,1)",
					            pointBackgroundColor: "rgba(179,181,198,1)",
					            pointBorderColor: "#fff",
					            pointHoverBackgroundColor: "#fff",
					            pointHoverBorderColor: "rgba(179,181,198,1)",
					            data: $wordnum
					        }
					    ]
					},
				    options: {
				            scale: {
				                reverse: true,
				                ticks: {
				                    beginAtZero: true
				                }
				            }
				    }
				});
	
			    }
			});



        });
      </script>


</html>