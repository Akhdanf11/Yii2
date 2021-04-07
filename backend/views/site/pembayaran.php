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
            <?php $form = ActiveForm::begin(['id' => 'form-pembayaran']); ?>
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
            </form>

            <div class="card-footer p-3 bg-primary">
                <small class="text-light"><span id="month" class="text-light">0</span> Bulan</small>
                <?= Html::submitButton('<i class="fas fa-check"></i>&nbsp;&nbsp;Bayar', ['class' => 'btn btn-light text-primary btn-sm ', 'id' => 'btn-pay', 'style' => 'float:right']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <button id="clearTable" class="btn btn-danger btn-sm ml-3 p-sm-2"><i class="fas fa-eraser mr-2"></i>Empty Table</button>
    <button id="printPDF" class="btn btn-sm btn-primary ml-4 p-sm-2"><i class="fas fa-print mr-2"></i>Print PDF</button>
</div>
<div class="row mt-sm-2">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
    <page>
        <div id="pdf-area" class="p-3">
            <h4 class="text-center mb-4 mt-2 font-weight-bolder">Struk Pembayaran Sekolah <span id="dateReport"></span></h4>
            <table class="table table-striped">
                <tr class="bg-success text-white">
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th>Tanggal & Waktu</th>
                    <th>Nominal</th>
                </tr>

                <tbody id="tbody" class="alert-info"></tbody>
            </table>
        </div>
    </page>
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

        function today() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, "0");
            var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
            var yyyy = today.getFullYear();
            today = mm + "-" + dd + "-" + yyyy;
            return today;
        }

        $("#clearTable").click(() => {
            $("#tbody").html("");
            $("#dateReport").html("");
        });

        $("#id-class").change(() => {
            getSiswa();
        });

        $("#id-skill").change(() => {
            getSiswa();
        });

        $("#btn-pay").click(() => {
            btnPay();
        });

        $("#printPDF").click(() => {
            printPDF("Laporan Pembayaran " + today());
        });

        function printPDF(name) {
            const pdf = document.getElementById("pdf-area");
            var opt = {
                margin: 0,
                filename: name + ".pdf",
                image: { type: "JPEG", quality: 1 },
                html2canvas: { scale: 1 },
                jsPDF: { unit: "in", format: "a4", orientation: "portrait" }
            };
            html2pdf().from(pdf).set(opt).save();
        }

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

        function btnPay(){
            let formData = new FormData;
            formData.append("nisn", $("#nama-siswa").val());
            formData.append("nominal", $("#nominal").val());
                $.ajax({
                    type : "POST",
                    url: "index.php?r=action%2Fform-pembayaran",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function() {
                        getSiswaData();
                    }
                });
        }

        function getSiswaData() {
            let formData = new FormData;
            formData.append("nisn", $("#nama-siswa").val());
            $.ajax({
                url : "index.php?r=action%2Fget-siswa-history",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#tbody").html("");
                    let num = 1;
                    let total = 0;
                    let nama;
                    let alias;
                    let kelas;
                    if(!data.data) {
                        alert("Data Tidak Ditemukan");
                    } else {
                        data.data.forEach((spp) => {
                            nama = spp.nama;
                            alias = spp.nama_jurusan;
                            kelas = spp.nama_kelas;
                            total += parseInt(spp.nominal);
                            let tr = document.createElement("tr");
                            let tdNum = document.createElement("td");
                            tdNum.innerHTML = num;
                            let tdNama = document.createElement("td");
                            tdNama.innerHTML = spp.nama;
                            let tdKelas = document.createElement("td");
                            tdKelas.innerHTML = spp.nama_kelas;
                            let tdSkill = document.createElement("td");
                            tdSkill.innerHTML = spp.nama_jurusan;
                            let tdDate = document.createElement("td");
                            tdDate.innerHTML = spp.created_at;
                            let tdNom = document.createElement("td");
                            tdNom.innerHTML = "Rp." + number_format(spp.nominal);
                            tr.append(tdNum);
                            tr.append(tdNama);
                            tr.append(tdKelas);
                            tr.append(tdSkill);
                            tr.append(tdDate);
                            tr.append(tdNom);
                            document.querySelector("#tbody").append(tr);
                            num++;
                        });
                        let tr = document.createElement("tr");
                        let tdJumlah = document.createElement("th");
                        tdJumlah.innerHTML = "Jumlah";
                        tdJumlah.setAttribute("colspan", "5");
                        let tdTotal = document.createElement("th");
                        tdTotal.innerHTML = "Rp." + number_format(total);
                        tr.append(tdJumlah);
                        tr.append(tdTotal);
                        document.querySelector("#tbody").append(tr);
                    }
                    $("#dateReport").html(nama + " " + kelas + " " + alias);
                }
            });
        }
    });', \yii\web\View::POS_READY);

?>

