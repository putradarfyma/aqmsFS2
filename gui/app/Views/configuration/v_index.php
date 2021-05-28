<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <form action="<?= base_url('configuration') ?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4"><?= lang('Global.Configuration Instrument') ?></h2>
                        <div class="alert alert-info">
                            <div class="d-flex justify-content-between">
                                <h3 class="h6">PORTS:</h3>
                                <span class="btn-show-all" style="cursor: pointer;" data-toggle="collapse" data-target="#collapse-sensor" aria-expanded="true" aria-controls="collapse-sensor">
                                    Show All <i class='fas fa-xs fa-arrow-circle-down'></i>
                                </span>
                            </div>
                            <?php foreach ($sensor_readers as $key => $sensor_reader) : ?>
                                <?php if ($key > 0) : ?>
                                    <div id="collapse-sensor" class="collapse">
                                        <p class="mb-1 small">
                                            <button type="button" class="btn btn-sm btn-outline-primary btn-copy" data-id="<?= $key ?>"><i class="fas fa-xs fa-copy"></i></button>
                                            <?= "<span data-id='{$key}'>{$sensor_reader->sensor_code}</span>  => " . str_replace(".py", "", $sensor_reader->driver) ?>
                                        </p>
                                    </div>
                                <?php else : ?>
                                    <p class="mb-1 small">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-copy" data-id="<?= $key ?>"><i class="fas fa-xs fa-copy"></i></button>
                                        <?= "<span data-id='{$key}'>{$sensor_reader->sensor_code}</span>  => " . str_replace(".py", "", $sensor_reader->driver) ?>
                                    </p>
                                <?php endif; ?>
                            <?php endforeach ?>
                        </div>
                        <?php foreach ($sensor_readers as $sensor_reader) : ?>
                            <div class="form-group">
                                <label><?= str_replace(".py", "", $sensor_reader->driver) ?></label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Port</label>
                                        <input type="text" name="sensor_code[<?= $sensor_reader->id ?>]" placeholder="Port" class="form-control" value="<?= $sensor_reader->sensor_code ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Parameter</label>
                                        <input type="text" name="driver[<?= $sensor_reader->id ?>]" placeholder="Parameter" class="form-control" value="<?= $sensor_reader->driver ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label>Baud Rate</label>
                                        <select name="baud_rate[<?= $sensor_reader->id ?>]" class="form-control">
                                            <option value="">Baud Rate</option>
                                            <option value="110" <?= $sensor_reader->baud_rate == 110 ? 'selected' : '' ?>> 110 </option>
                                            <option value="300" <?= $sensor_reader->baud_rate == 300 ? 'selected' : '' ?>> 300 </option>
                                            <option value="1200" <?= $sensor_reader->baud_rate == 1200 ? 'selected' : '' ?>> 1200 </option>
                                            <option value="2400" <?= $sensor_reader->baud_rate == 2400 ? 'selected' : '' ?>> 2400 </option>
                                            <option value="4800" <?= $sensor_reader->baud_rate == 4800 ? 'selected' : '' ?>> 4800 </option>
                                            <option value="9600" <?= $sensor_reader->baud_rate == 9600 ? 'selected' : '' ?>> 9600 </option>
                                            <option value="19200" <?= $sensor_reader->baud_rate == 19200 ? 'selected' : '' ?>> 19200 </option>
                                            <option value="38400" <?= $sensor_reader->baud_rate == 38400 ? 'selected' : '' ?>> 38400 </option>
                                            <option value="57600" <?= $sensor_reader->baud_rate == 57600 ? 'selected' : '' ?>> 57600 </option>
                                            <option value="115200" <?= $sensor_reader->baud_rate == 115200 ? 'selected' : '' ?>> 115200 </option>
                                            <option value="230400" <?= $sensor_reader->baud_rate == 230400 ? 'selected' : '' ?>> 230400 </option>
                                            <option value="460800" <?= $sensor_reader->baud_rate == 460800 ? 'selected' : '' ?>> 460800 </option>
                                            <option value="921600" <?= $sensor_reader->baud_rate == 921600 ? 'selected' : '' ?>> 921600 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4">Detail</h2>
                        <div class="form-group">
                            <label><?= lang('Global.Station Name') ?></label>
                            <input type="text" name="nama_stasiun" placeholder="<?= lang('Global.Station Name') ?>" value="<?= $__this->findConfig('nama_stasiun') ?>" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Station ID</label>
                                    <input type="text" name="id_stasiun" placeholder="Station ID" value="<?= $__this->findConfig('id_stasiun') ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?= lang('Global.City') ?></label>
                                    <input type="text" name="city" value="<?= $__this->findConfig('city') ?>" placeholder="<?= lang('Global.City') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><?= lang('Global.Province') ?></label>
                                    <input type="text" name="province" value="<?= $__this->findConfig('province') ?>" placeholder="<?= lang('Global.Province') ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label><?= lang('Global.Full Address') ?></label>
                            <textarea name="address" rows="2" placeholder="<?= lang('Global.Full Address') ?>" class="form-control"><?= $__this->findConfig('address') ?></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Latitude</label>
                                    <input type="text" name="latitude" placeholder="Latitude" value="<?= $__this->findConfig('latitude') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Longitude</label>
                                    <input type="text" name="longitude" placeholder="Longitude" value="<?= $__this->findConfig('longitude') ?>" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="bg-light px-3 py-2">
                        <h2 class="h4"><?= lang('Global.Configuration') ?> Dashboard</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small"><?= lang('Global.Interval') ?> <?= lang('Global.Pump') ?> <small>(<?= lang('Global.Minutes') ?>)</small></label>
                                    <input type="text" name="pump_interval" value="<?= $__this->findConfig('pump_interval') ?>" placeholder="<?= lang('Global.Interval') ?> <?= lang('Global.Pump') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small"><?= lang('Global.Collect Data Interval') ?> <small>(<?= lang('Global.Minutes') ?>)</small></label>
                                    <input type="text" name="data_interval" value="<?= $__this->findConfig('data_interval') ?>" placeholder="<?= lang('Global.Collect Data Interval') ?>" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small"><?= lang('Global.Graphic Refresh Interval') ?> <small>(<?= lang('Global.Minutes') ?>)</small></label>
                                    <input type="text" name="graph_interval" value="<?= $__this->findConfig('graph_interval') ?>" placeholder="<?= lang('Global.Graphic Refresh Interval') ?>" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="position-fixed" style="z-index: 999;right:11vw;bottom:20px;">
            <button type="submit" name="Save" class="btn btn-info" id="btn-save"><?= lang('Global.Save Changes') ?></button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    // Copy to clipboard
    const copyToClipboard = str => {
        const el = document.createElement('textarea');
        el.value = str;
        el.setAttribute('readonly', '');
        el.style.position = 'absolute';
        el.style.left = '-9999px';
        document.body.appendChild(el);
        el.select();
        document.execCommand('copy');
        document.body.removeChild(el);
    };
</script>
<script>
    $(document).ready(function() {
        $('.btn-copy').click(function() {
            let id = $(this).attr('data-id');
            let text = $(`span[data-id="${id}"]`).text();
            copyToClipboard(text);
            toastr.success(`${text} berhasil disalin ke clipboard`);
        });
        $('.btn-show-all').click(function() {
            let show = $(this).attr('data-show');
            $(this).attr('data-show', show === 'true' ? 'false' : 'true');
            if (show === 'true') {
                $(this).html(`Show All <i class='fas fa-xs fa-arrow-circle-down'></i>`);
            } else {
                $(this).html(`Hidden <i class='fas fa-xs fa-arrow-circle-up'></i>`);
            }
        });
    });
</script>
<!-- <script>
    // Get Geolocation
    $(document).ready(function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                const latitude = position?.coords?.latitude;
                const longitude = position?.coords?.longitude;
                $(`input[name='long']`).val(longitude);
                $(`input[name='lat']`).val(latitude);
            }, (error) => {
                console.log(`Error : ${error.code} - ${error.message}`);
            }, {
                enableHightAccuracy: true,
                maximumAge: 30000,
                timeout: 27000,
            });
        } else {
            console.log(`Geolocation not support on this browser`);
        }
    });
</script> -->
<?= $this->endSection() ?>