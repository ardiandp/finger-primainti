123

<script>
    var chart1; 
    $(document).ready(function() {
          chart1 = new Highcharts.Chart({
             chart: {
                renderTo: 'mygraph',
                type: 'column'
             },   
             title: {
                text: 'Internet Browser Statistics '
             },
             xAxis: {
                categories: ['Browser']
             },
             yAxis: {
                title: {
                   text: 'Total Browser Usage'
                }
             },
                  series:             
                [
                    <?php 
                    //
                    include "connection.php";
                    $sql   = "SELECT browsername  FROM browser";
                    $query = mysqli_query( $con, $sql )  or die(mysqli_error());
                    while( $temp = mysqli_fetch_array( $query ) )
                    {
                        $trendbrowser=$temp['browsername'];                     
                        $sql_total   = "SELECT total FROM browser WHERE browsername='$trendbrowser'";        
                        $query_total = mysqli_query($con,$sql_total ) or die(mysql_error());
                        while( $data = mysqli_fetch_array( $query_total ) )
                        {
                            $total = $data['total'];                 
                        }             
                    ?>
                        {
                          name: '<?php echo $trendbrowser; ?>',
                          data: [<?php echo $total; ?>]
                        },
                        <?php 
                    }   ?>
                    ]
          });
       });  
</script>


<body>
<div class="container" style="margin-top:20px">
    <div class="col-md-7">
        <div class="panel panel-primary">
            <div class="panel-heading">The Graph of Browser Trends January 2015</div>
                <div class="panel-body">
                    <div id ="mygraph"></div>
                </div>
        </div>
    </div>
</div>

</body>