<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Jurusan;
use frontend\models\Kelas;

$this->title = 'Payment';
?>
<h1 class="my-4">Payment</h1>

<?php if(isset($payment)): ?>
<div class="alert alert-success" id="alert-payment">Pembayaran Berhasil</div>
<?php endif; ?>

<div class="row">
    
    <div class="col-lg-6">
        <div class="card">
    
        <div class="card-header bg-primary text-light">
            <i class="fas fa-user-friends mr-2"></i>
            Data Siswa
        </div>

        <div class="card-body">
            <?php $form = ActiveForm::begin(['id' => 'bio-form']); ?>
            <div class="row">
                <div class="col-4">
                    <b class="mb-2 d-block">Kelas</b>
                    <?= Html::activeDropDownList(new Kelas, 'id', ArrayHelper::map(Kelas::find()->all(), 'id', 'nama'), ['class' => "form-control siswa-form", "id" => "id-class", 'prompt' => '~ Kelas ~']) ?>
                </div>

                <div class="col-8">
                    <b class="mb-2 d-block">Jurusan</b>
                    <?= Html::activeDropDownList(new Jurusan, 'id', ArrayHelper::map(Jurusan::find()->all(), 'id', 'nama'), ['class' => "form-control siswa-form", "id" => "id-skill", 'prompt' => '~ Jurusan ~']) ?>
                </div>

                <div class="col-12 mt-3">
                    <b class="mb-2 d-block">Nama</b>
                    <select class="form-control" id="nama-siswa" name="nama-siswa">
                        <option>Mohon Pilih Kelas Dan Jurusan Terlebih Dahulu</option>
                    </select>
                </div>
            </div>
            
        </div>

        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            

            <div class="card-header bg-primary text-light">
                <span><b>Rp</b></span>
                Transaksi
            </div>

            <div class="card-content p-3" id="transaksi">
                <div class="row">
                    <div class="col-12">
                        <b class="mb-2 d-block">Nominal</b>
                        <?= $form->field($model, 'nominal')->textInput(['id' => 'nominal', 'placeholder' => 'Cth. 200000'])->label(false); ?>
                    </div>

                    <div class="col-12">
                        <b class="mb-2 d-block">Kembalian</b>
                        <input type="text" disabled="true" id="exchange" class="form-control">
                    </div>
                </div>
            </div>

            <div class="card-footer p-3 bg-primary">
                <small class="text-light"><span id="month" class="text-light">0</span> Bulan</small>
                <?= Html::submitButton('<i class="fas fa-check"></i>&nbsp;&nbsp;Bayar', ['class' => 'btn btn-light text-primary btn-sm ', 'id' => 'btn-pay', 'style' => 'float:right']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>

<?php

$this->registerJs('
    $(document).ready(function(){

        let price = 135000;
        $("#transaksi").slideToggle();
        $("#nama-siswa").prop("disabled", "true");
        $("#btn-pay").prop("disabled", "true");

        $("#nominal").on("keyup", (event) => {
            if (parseInt($("#nominal").val()) < price) {
                $("#exchange").val("0");
                $("#month").html("0");
                $("#btn-pay").prop("disabled", "true");
            } else {
                $("#btn-pay").removeAttr("disabled");
                $("#exchange").val( parseInt($("#nominal").val()) % price);
                $("#month").html(Math.floor(parseInt($("#nominal").val())/price));
            }
        });

        $("#id-class").change(() => {
            getSiswa();
        });

        $("#id-skill").change(() => {
            getSiswa();
        });
        
        setTimeout(function() {
            $("#alert-payment").hide();
        }, 2000);

        function getSiswa() {
            let formData = new FormData;
            formData.append("class", $("#id-class").val());
            formData.append("skill", $("#id-skill").val());
            $.ajax({
                url : "index.php?r=action%2Fget-siswa",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#nama-siswa").html("");
                    $("#btn-pay").prop("disabled", "true");
                    $("#transaksi").slideUp();
                    if($("#id-skill").val() != "" && $("#id-class").val() != "") {
                        if(!data.siswa) {
                            $("#nama-siswa").prop("disabled", "true");
                        } else {
                            data.siswa.forEach((siswa) => {
                                let option = document.createElement("option");
                                option.setAttribute("value", siswa.nisn);
                                option.innerHTML = siswa.nama;

                                document.querySelector("#nama-siswa").append(option);
                            });
                            $("#transaksi").slideDown();
                            $("#nama-siswa").removeAttr("disabled");
                        }
                    } else {
                        $("#transaksi").slideUp();
                        $("#btn-pay").prop("disabled", "true");
                        $("#nama-siswa").prop("disabled", "true");
                    }
                }
            });
        }

    });', \yii\web\View::POS_READY);

?>