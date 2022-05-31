<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="bg-light px-3 py-2">
                    <h2 class="h4"><?= lang('Global.zero_calibrations') ?></h2>
                    <div class="form-group">
                        <label><?= lang('Global.calibrator_name') ?></label>
                        <input type="text" id="calibrator_name" name="calibrator_name" placeholder="<?= lang('Global.calibrator_name') ?>" value="<?= $__this->findConfig('calibrator_name') ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?= lang('Global.zerocal_duration') ?> <small>(<?= lang('Global.Seconds') ?>)</small></label>
                        <input type="text" id="zerocal_duration" name="zerocal_duration" placeholder="<?= lang('Global.zerocal_duration') ?>" value="<?= $__this->findConfig('zerocal_duration') ?>" class="form-control">
                    </div>
                    <button id="btn_start_zero_calibration" class="btn btn-success btn-lg float-right" onclick="start_zero_calibration()"><?= lang('Global.start'); ?></button>
                    <button id="btn_force_stop_zero_calibration" class="btn btn-warning btn-lg float-right d-none" onclick="force_stop_zero_calibration()"><?= lang('Global.force_stop'); ?></button>
                </div>
            </div>
        </div>
    </div>


    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <b>
                    <h4><?= lang('Global.zero_calibrating_status'); ?></h4>
                </b>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>Started At</td>
                            <td id="zerocal_started_at"></td>
                        </tr>
                        <tr>
                            <td>Finish At</td>
                            <td id="zerocal_finished_at"></td>
                        </tr>
                        <tr>
                            <td>Remaining</td>
                            <td id="calibration_remaining"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Concentration (ppm)</th>
                            <th scope="col">Voltage</th>
                            <th scope="col">Temp (°C)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Board1 [0]</td>
                            <td id="con_membrasens_0_0">0</td>
                            <td id="volt_membrasens_0_0">0</td>
                            <td id="temp_membrasens_0_0">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [1]</td>
                            <td id="con_membrasens_0_1">0</td>
                            <td id="volt_membrasens_0_1">0</td>
                            <td id="temp_membrasens_0_1">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [2]</td>
                            <td id="con_membrasens_0_2">0</td>
                            <td id="volt_membrasens_0_2">0</td>
                            <td id="temp_membrasens_0_2">0</td>
                        </tr>
                        <tr>
                            <td>Board1 [3]</td>
                            <td id="con_membrasens_0_3">0</td>
                            <td id="volt_membrasens_0_3">0</td>
                            <td id="temp_membrasens_0_3">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [0]</td>
                            <td id="con_membrasens_1_0">0</td>
                            <td id="volt_membrasens_1_0">0</td>
                            <td id="temp_membrasens_1_0">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [1]</td>
                            <td id="con_membrasens_1_1">0</td>
                            <td id="volt_membrasens_1_1">0</td>
                            <td id="temp_membrasens_1_1">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [2]</td>
                            <td id="con_membrasens_1_2">0</td>
                            <td id="volt_membrasens_1_2">0</td>
                            <td id="temp_membrasens_1_2">0</td>
                        </tr>
                        <tr>
                            <td>Board2 [3]</td>
                            <td id="con_membrasens_1_3">0</td>
                            <td id="volt_membrasens_1_3">0</td>
                            <td id="temp_membrasens_1_3">0</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-md-12 my-2">
            <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">

                <div class="card-body">
                    <div class="chart">
                        <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-start">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Zero Calibration Logs</h4>
                </div>
                <div class="card-body">
                    <form class="form-inline" method="get" id="formExport" action="<?= base_url("calibration/validateExport"); ?>">
                        <label class="mr-1" for="started_at">Started at: </label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="started_at">

                        <label class="mr-1" for="end_at">End at :</label>
                        <input type="date" class="form-control form-control-sm mb-2 mr-sm-2" name="end_at">
                        <button type="submit" class="btn btn-success btn-sm mb-2">Export CSV <i class="ml-1 fas fa-xs fa-download"></i></button>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tblCalibrationLogs">
                            <thead>
                                <th>Calibrator Name</th>
                                <th>Start At</th>
                                <th>Finish At</th>
                                <th>Sensor </th>
                                <th>PIN</th>
                                <th>Value</th>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>

<script>
    $(document).ready(function() {
        $('#formExport').submit(function() {
            $.ajax({
                url: $(this).attr('action'),
                type: 'get',
                dataType: 'json',
                data: $(this).serialize(),
                success: function(data) {
                    if (data?.success) {
                        setTimeout(() => {
                            window.location.href = data?.download_url;
                        }, 1200);
                    }
                },
                error: function(xhr, status, err) {

                }
            })
        })



        var begin = 1;
        var beginUnit = 1;
        setInterval(() => {
            $.ajax({
                url: '<?= base_url('rht/sensor_values') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        $("#con_membrasens_0_0").html(data.con_membrasens_0_0);
                        $("#con_membrasens_0_1").html(data.con_membrasens_0_1);
                        $("#con_membrasens_0_2").html(data.con_membrasens_0_2);
                        $("#con_membrasens_0_3").html(data.con_membrasens_0_3);
                        $("#volt_membrasens_0_0").html(data.volt_membrasens_0_0);
                        $("#volt_membrasens_0_1").html(data.volt_membrasens_0_1);
                        $("#volt_membrasens_0_2").html(data.volt_membrasens_0_2);
                        $("#volt_membrasens_0_3").html(data.volt_membrasens_0_3);
                        $("#temp_membrasens_0_0").html(data.temp_membrasens_0_0);
                        $("#temp_membrasens_0_1").html(data.temp_membrasens_0_1);
                        $("#temp_membrasens_0_2").html(data.temp_membrasens_0_2);
                        $("#temp_membrasens_0_3").html(data.temp_membrasens_0_3);
                        $("#con_membrasens_1_0").html(data.con_membrasens_1_0);
                        $("#con_membrasens_1_1").html(data.con_membrasens_1_1);
                        $("#con_membrasens_1_2").html(data.con_membrasens_1_2);
                        $("#con_membrasens_1_3").html(data.con_membrasens_1_3);
                        $("#volt_membrasens_1_0").html(data.volt_membrasens_1_0);
                        $("#volt_membrasens_1_1").html(data.volt_membrasens_1_1);
                        $("#volt_membrasens_1_2").html(data.volt_membrasens_1_2);
                        $("#volt_membrasens_1_3").html(data.volt_membrasens_1_3);
                        $("#temp_membrasens_1_0").html(data.temp_membrasens_1_0);
                        $("#temp_membrasens_1_1").html(data.temp_membrasens_1_1);
                        $("#temp_membrasens_1_2").html(data.temp_membrasens_1_2);
                        $("#temp_membrasens_1_3").html(data.temp_membrasens_1_3);
                    }

                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
            $.ajax({
                url: '<?= base_url('calibration/get_data') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        $("#zerocal_started_at").html(data.zerocal_started_at);
                        $("#zerocal_finished_at").html(data.zerocal_finished_at);
                        $("#calibration_remaining").html(data.remaining);
                        if (data.is_zerocalibrating == 0) {
                            $("#btn_start_zero_calibration").removeClass("d-none");
                            $("#btn_force_stop_zero_calibration").addClass("d-none");
                        } else {
                            $("#btn_start_zero_calibration").addClass("d-none");
                            $("#btn_force_stop_zero_calibration").removeClass("d-none");
                        }
                    }
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })

        }, 1000);

        $('#tblCalibrationLogs').DataTable({
            lengthChange: false,
            scrollY: 200,
            orderable: false,
            fixedHeader: true,
            ajax: {
                url: `<?= base_url('calibration/datatable') ?>`,
                data: function(data) {
                    data.started_at = $('input[name="started)at"]').val();
                    data.end_at = $('input[name="end_at"]').val();
                }
            },
            ordering: false,
            searching: false,
            processing: true,
            serverSide: true,
            destroy: true,
            columns: [{
                    data: 'calibrator_name'
                },
                {
                    data: 'started_at'
                },
                {
                    data: 'xtimestamp'
                },
                {
                    data: 'sensor_code'
                },
                {
                    data: 'pin'
                },
                {
                    data: 'value',
                    width: 300
                },

            ]
        });


    });

    function start_zero_calibration() {
        $.ajax({
            url: "<?= base_url(); ?>/calibration/zero_calibration_starting/" + $("#calibrator_name").val() + "/" + $("#zerocal_duration").val(),
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, err) {
                console.log(err);
            }
        })
    }

    function force_stop_zero_calibration() {
        $.ajax({
            url: "<?= base_url(); ?>/calibration/force_stop_zero_calibration/",
            dataType: 'json',
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, err) {
                console.log(err);
            }
        })
    }
</script>


<script src="<?= base_url('bootstrap/js/Chart.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            animation: {
                duration: 0
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        lineChartOptions.datasetFill = false

        setInterval(() => {
            $.ajax({
                url: '<?= base_url('rht/sensor_value_logs') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        let datasets_ = new Array();
                        i = 0;
                        data.datasets.forEach(function(object) {
                            obj = JSON.parse(object);
                            datasets_[i] = {
                                borderColor: obj.borderColor,
                                pointRadius: obj.pointRadius,
                                data: JSON.parse(obj.data)
                            };
                            i++;
                        });

                        var areaChartData = {
                            labels: data.labels,
                            datasets: datasets_
                        }

                        // console.log(areaChartData);

                        var lineChartData = $.extend(true, {}, areaChartData)

                        var lineChart = new Chart(lineChartCanvas, {
                            type: 'line',
                            data: lineChartData,
                            options: lineChartOptions
                        })
                    }
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }, 1000);
    });
</script>


<?= $this->endSection() ?>