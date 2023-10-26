<?php
$page = "dashboard";
$title = "Dashboard";

include './partials/header.php';

?>

<section class="dashboard">
    <div class="container dashboard_container">
        <button id="show_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-right-b"></i></button>
        <button id="hide_sidebar_btn" class="sidebar_toggle"><i class="uil uil-angle-left-b"></i></button>
        <?php include './partials/aside.php' ?>
        <main class="report">
            <?php include  '../php/dashboard-logic.php'; ?>
            <h2>Dashboard</h2>
            <div class="row">
                <div class="col-12">
                    <div class="cards">
                        <div class="card one">
                            <h3>Total Number of Students</h3>
                            <span><?= $all_result ?></span>
                        </div>
                        <div class="card three">
                            <h3>Number of Registered Students</h3>
                            <span><?= $reg_result ?></span>
                        </div>
                        <div class="card two">
                            <h3>Number of Successful Applications</h3>
                            <span><?= $success_result ?></span>
                        </div>
                        <div class="card fourth">
                            <h3>Pending Applications</h3>
                            <span><?= $pending_result ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="g-cards">
                        <div class="g-card" id="Chart">
                            <h3>Number of Registered Students</h3>
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</section>


<!-- ******************** End OF FORM SECTION *********************** -->

<script src="../js/chartjs/chart.min.js"></script>
<script src="../js/chartjs/chartjs-plugin-datalabels.min.js"></script>
<!-- <script src="../js/dashboardjs/chart.js"></script> -->
<script>
    var ctx = document.getElementById('barChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $gx ?>],
        datasets: [{
            label: 'Number of Contracts',
            data: [<?php echo $gy ?>],
            backgroundColor: [
                'rgba(2, 99, 255, 1)',
                'rgba(255, 119, 35, 1)',
                'rgba(142, 48, 255, 1)',
                'rgba(237, 172, 121, 1)',
                'rgba(173, 51, 190, 1)',
                'rgba(173, 51, 19, 1)',
            ],
            borderColor: [
                'rgba(2, 99, 255, 1)',
                'rgba(255, 119, 35, 1)',
                'rgba(142, 48, 255, 1)',
                'rgba(237, 172, 121, 1)',
                'rgba(173, 51, 190, 1)',
                'rgba(173, 51, 19, 1)',
            ],
            borderWidth: 1
        }]
    },
    // OR only to specific charts:
    plugins: [ChartDataLabels],
    options: {
        maintainAspectRatio: false,
        responsive: true,
        
        plugins:{
            layout: {
                padding: 20
            },
            legend:{
                display: false
            },
            datalabels:{
                anchor: 'end',
                align: 'top'
            }
           
        },
        scales: {
            y:{
                grace: '10%'
            }
        },
    },

        color: 'black',
        
    });


</script>
<?php
include '../partials/footer.php';
?>


