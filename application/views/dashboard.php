<!DOCTYPE html>
<html lang="en">
    <head>    
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

        <title>Dashboard | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>        

        <?php base_url() . include 'include.php'; ?>  
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">

                <?php base_url() . include 'header.php'; ?>  
                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="row mt-4">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>main-category">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <em class="fas fa-cube"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Categories</h4>
                                            </div>
                                            <div class="card-body"><?= $count_category; ?></div>
                                        </div>
                                    </div>
                                </a>                               
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>sub-category">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-danger">
                                            <em class="fas fa-cubes"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Sub Categories</h4>
                                            </div>
                                            <div class="card-body"><?= $count_subcategory; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>manage-questions">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-warning">
                                            <em class="far fa-question-circle"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Questions</h4>
                                            </div>
                                            <div class="card-body"><?= $count_question; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>users">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <em class="fas fa-users"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Registered Devices</h4>
                                            </div>
                                            <div class="card-body"><?= $count_user; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>contest">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-success">
                                            <em class="fas fa-trophy"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Live Contests</h4>
                                            </div>
                                            <div class="card-body"><?= $count_live_contest; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>fun-n-learn">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-warning">
                                            <em class="fas fa-graduation-cap"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Fun 'N' Learn</h4>
                                            </div>
                                            <div class="card-body"><?= $count_fun_n_learn; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>guess-the-word">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-danger">
                                            <em class="far fa-lightbulb"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>Guess The Word</h4>
                                            </div>
                                            <div class="card-body"><?= $count_guess_the_word; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <a href="<?= base_url(); ?>user-accounts-rights">
                                    <div class="card card-statistic-1">
                                        <div class="card-icon bg-primary">
                                            <em class="fas fa-user-secret"></em>
                                        </div>
                                        <div class="card-wrap">
                                            <div class="card-header">
                                                <h4>System Users</h4>
                                            </div>
                                            <div class="card-body"><?= $count_system_user; ?></div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h6>User Registrations</h6>
                                            <select id="yearDropdown" class="form-control" style="width: auto;">
                                                <?php
                                                    if(isset($years) && !empty($years)){
                                                        foreach ($years as $year) {
                                                            $currentYear = 0;
                                                            if($year == date('Y')){
                                                                ?> <option value="<?= $year ?>" selected> <?= $year ?></option>
                                                        <?php }else {
                                                            ?> <option value="<?= $year ?>" selected> <?= $year ?></option>
                                                        <?php }
                                                        ?>
                                                    <?php }
                                                    }else{?>
                                                        <option value="<?= date('Y') ?>" selected> <?= date('Y') ?></option>
                                                    <?php }
                                                ?>
                                            </select>
                                        </div>
                                        <ul class="nav nav-pills" id="myTab3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="day-tab3" data-toggle="tab" href="#day3" role="tab" aria-controls="day" aria-selected="true">Day</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="week-tab3" data-toggle="tab" href="#week3" role="tab" aria-controls="week" aria-selected="false">Week</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="month-tab3" data-toggle="tab" href="#month3" role="tab" aria-controls="month" aria-selected="false">Month</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent2">
                                            <div class="tab-pane fade  active show" id="day3" role="tabpanel" aria-labelledby="day-tab3">
                                                <canvas id="dayChart" height="100"></canvas>
                                            </div>
                                            <div class="tab-pane fade" id="week3" role="tabpanel" aria-labelledby="week-tab3">
                                                <canvas id="weekChart" height="100"></canvas>
                                            </div>
                                            <div class="tab-pane fade" id="month3" role="tabpanel" aria-labelledby="month-tab3">
                                                <canvas id="monthChart" height="100"></canvas>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

            </div>
        </div>

        <?php base_url() . include 'footer.php'; ?> 

        <script src="<?= base_url(); ?>assets/js/chart.min.js" type="text/javascript"></script>

        <script type="text/javascript">
<?php
$mLable = $mData = array();
foreach ($month_data as $mD) {
    $mLable[] = $mD->month_name;
    $mData[] = ($mD->user_count == NULL) ? 0 : (int) $mD->user_count;
}
$mName = json_encode($mLable);
$mD = json_encode($mData);

$wLable = $wData = array();
foreach ($week_data as $wD) {
    $wLable[] = $wD->day_name;
    $wData[] = ($wD->user_count == NULL) ? 0 : (int) $wD->user_count;
}
$wName = json_encode($wLable);
$wD = json_encode($wData);

$dLable = $dData = array();
foreach ($day_data as $dD) {
    $dLable[] = $dD->day_name;
    $dData[] = (int) $dD->user_count;
}
$dName = json_encode($dLable);
$dD = json_encode($dData);

// For day data
$maxDayData = $dData ? max($dData) : 0;
$stepSizeDay = $maxDayData > 10 ? round($maxDayData / 10) : 1; // Change 10 to the number of steps you want

// For week data
$maxWeekData = $wData ? max($wData) : 0;
$stepSizeWeek = $maxWeekData > 10 ? round($maxWeekData / 10) : 1; // Change 10 to the number of steps you want

// For month data
$maxMonthData = $mData ? max($mData) : 0;
$stepSizeMonth = $maxMonthData > 10 ? round($maxMonthData / 10) : 1; // Change 10 to the number of steps you want
?>

            var daytx = document.getElementById("dayChart").getContext('2d');
            var myChart = new Chart(daytx, {
                type: 'bar',
                data: {
                    labels: <?= $dName; ?>,
                    datasets: [{
                            label: 'Statistics',
                            data: <?= $dD ?>,
                            borderWidth: 2,
                            backgroundColor: '<?=$theme_color ?? "#f05387" ?>',
                            borderColor: '<?=$theme_color ?? "#f05387" ?>',
                            pointBackgroundColor: '#ffffff',
                            pointRadius: 4
                        }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: <?= $stepSizeDay ?>
                                }
                            }],
                        xAxes: [{
                                ticks: {
                                    display: true
                                },
                                gridLines: {
                                    display: false
                                }
                            }]
                    },
                }
            });

            var weektx = document.getElementById("weekChart").getContext('2d');
            var myChart = new Chart(weektx, {
                type: 'bar',
                data: {
                    labels: <?= $wName; ?>,
                    datasets: [{
                            label: 'Statistics',
                            data: <?= $wD ?>,
                            borderWidth: 2,
                            backgroundColor: '<?=$theme_color ?? "#f05387" ?>',
                            borderColor: '<?=$theme_color ?? "#f05387" ?>',
                            pointBackgroundColor: '#ffffff',
                            pointRadius: 4
                        }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: <?= $stepSizeWeek ?>
                                }
                            }],
                        xAxes: [{
                                ticks: {
                                    display: true
                                },
                                gridLines: {
                                    display: false
                                }
                            }]
                    },
                }
            });


            var monthtx = document.getElementById("monthChart").getContext('2d');
            var monthChartVar;
            monthChartVar = new Chart(monthtx, {
                type: 'bar',
                data: {
                    labels: <?= $mName; ?>,
                    datasets: [{
                            label: 'Statistics',
                            data: <?= $mD ?>,
                            borderWidth: 2,
                            backgroundColor: '<?=$theme_color ?? "#f05387" ?>',
                            borderColor: '<?=$theme_color ?? "#f05387" ?>',
                            pointBackgroundColor: '#ffffff',
                            pointRadius: 4
                        }]
                },
                options: {
                    legend: {
                        display: false
                    },
                    scales: {
                        yAxes: [{
                                gridLines: {
                                    drawBorder: false,
                                    color: '#f2f2f2',
                                },
                                ticks: {
                                    beginAtZero: true,
                                    stepSize: <?= $stepSizeMonth ?>
                                }
                            }],
                        xAxes: [{
                                ticks: {
                                    display: true
                                },
                                gridLines: {
                                    display: false
                                }
                            }]
                    },
                }
            });

            $(document).ready(function () {
                $("#yearDropdown").hide();
                $('#month-tab3').trigger('click');
            });
            $("#month-tab3").on('click',function(){
                $("#yearDropdown").show();
            });
            $("#week-tab3").on('click',function(){
                $("#yearDropdown").hide();
            });
            $("#day-tab3").on('click',function(){
                $("#yearDropdown").hide();
            });
            
            $("#yearDropdown").on("change", function () {
                var base_url = "<?php echo base_url(); ?>";
                let value = $(this).val();
                $.ajax({
                    url: base_url + 'dashboard-year/' + value,
                    type: "GET",
                    success: function (response) {
                        response = JSON.parse((response));
                        var mName = response.mName;
                        var mD = response.mD;
                        var stepSizeMonth = response.stepSizeMonth

                        var monthtx = document.getElementById("monthChart").getContext('2d');
                        // If the chart exists, destroy it before creating a new one
                        if (monthChartVar) {
                            monthChartVar.destroy();
                        }
                        monthChartVar = new Chart(monthtx, {
                            type: 'bar',
                            data: {
                                labels: mName,
                                datasets: [{
                                    label: 'Statistics',
                                    data: mD,
                                    borderWidth: 2,
                                    backgroundColor: '<?=$theme_color ?? "#f05387" ?>',
                                    borderColor: '<?=$theme_color ?? "#f05387" ?>',
                                    pointBackgroundColor: '#ffffff',
                                    pointRadius: 4
                                }]
                            },
                            options: {
                                legend: {
                                    display: false
                                },
                                scales: {
                                    yAxes: [{
                                        gridLines: {
                                            drawBorder: false,
                                            color: '#f2f2f2',
                                        },
                                        ticks: {
                                            beginAtZero: true,
                                            stepSize: stepSizeMonth
                                        }
                                    }],
                                    xAxes: [{
                                        ticks: {
                                            display: true
                                        },
                                        gridLines: {
                                            display: false
                                        }
                                    }]
                                },
                            }
                        });
                    }
                });
            });
        </script>
    </body>

</html>