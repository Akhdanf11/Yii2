<?php
use yii\helpers\Html;
?>

<?php if(isset($payment)): ?>
<div class="alert alert-success" id="alert-payment">Pembayaran Berhasil</div>
<?php endif; ?>

<div class="row mt-sm-2">
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
    <page>
        <div id="pdf-area" class="p-3">
            <h4 class="text-center mb-4 mt-2 font-weight-bolder">Struk Pembayaran Sekolah <?= Html::encode($model->nisn) ?><span id="dateReport"></span></h4>
            <table class="table table-striped">
                <tr class="bg-success text-white">
                    <th>No.</th>
                    <th>NISN</th>
                    <th>Nominal</th>
                </tr>

                <tbody id="tbody" class="alert-info"></tbody>
                <tr>
                <td>1</td>
                <td><?= Html::encode($model->nisn) ?></td>
                <td><?= Html::encode($model->nominal) ?></td>
                </tr>
            </table>
        </div>
    </page>
    </div>
</div>
<div class="row">
<div class="col-lg-3"></div>
    <div class="col-lg-3">
    <button id="back" class="btn btn-danger btn-block ml-4 p-sm-2"><i class="fas fa-chevron-left mr-2"></i>Back</button>
    </div>
    <div class="col-lg-3">
    <button id="printPDF" class="btn btn-block btn-primary ml-4 p-sm-2"><i class="fas fa-print mr-2"></i>Print PDF</button>
    </div>
</div>
<?php

$this->registerJs('
    $(document).ready(function(){
    

        function today() {
            var today = new Date();
            var dd = String(today.getDate()).padStart(2, "0");
            var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
            var yyyy = today.getFullYear();
            today = mm + "-" + dd + "-" + yyyy;
            return today;
        }

        $("#back").click(() => {
            window.location.href = "index.php?r=site%2Fpembayaran";
        });


        $("#printPDF").click(() => {
            let formData = new FormData;
            formData.append("nisn", $("#nama-siswa").val());    
            printPDF("Struk Pembayaran " + today());
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

        
    });', \yii\web\View::POS_READY);
?>

<?php if (isset($payment)) {
    $this->registerJs('
    $(document).ready(function(){
        setTimeout(() => {
            $("#alert-payment").fadeOut();
        }, 2000
    );
    });', \yii\web\View::POS_READY);
} ?>