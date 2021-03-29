<?php

/* @var $this yii\web\View */

$this->title = 'Riwayat Pembayaran';
?>
<div class="pt-2">

    <div class="row">
        <div class="col-lg-1"></div>
        <div class="col-lg-9 card p-5 my-2 bg-primary text-light">
        <h2 class="text-center"><i class="fas fa-file-invoice-dollar mr-2"></i> Riwayat Pembayaran</h2>
                <hr>
            <div class="card bg-light text-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <b class="mb-2 d-block"><i class="far fa-calendar-alt mr-2"></i>Berdasarkan Waktu Jarak Tanggal</b>
                            <input id="datepicker" autocomplete="off" style="cursor:pointer!important;" class="form-control" type="text" />
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light text-primary">
                    <button id="getRangeHistory" class="btn btn-sm btn-primary text-light"><i class="far fa-eye mr-2"></i>Lihat</button>
                </div>
            </div>
            <hr class="sidebar-divider d-none d-md-block">

                <button id="findAll" class="btn btn-light text-primary mb-3 float-right"><i class="fas fa-search mr-2"></i>Lihat Semua Pembayaran</button>
            <fieldset class="border px-1 py-1 bg-light">
                <div id="table">
                    <table class="table table-striped">
                        <tr class="bg-primary text-light">
                            <th>No</th>
                            <th>Tanggal Dan Waktu</th>
                            <th>Nominal</th>
                        </tr>
                        <tbody id="tbody" class=" alert-primary">
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-lg-3">
            <button id="clearTable" class="btn btn-danger btn-sm ml-3 p-sm-2"><i class="fas fa-eraser mr-2"></i>Empty Table</button>
            </div>
            </fieldset>
        </div>
    </div>
</div>

<?php

$this->registerJs('
    $(document).ready(function(){
        $("#table").slideUp();
        $("#clearTable").slideUp();
        $("#datepicker").daterangepicker({
            "timepicker" : true,
            "applyClass": "btn-dark"
        }, function(start, end, label) {
            $("#table").slideUp();
            let formData = new FormData;
            formData.append("date1", start.format("YYYY-MM-DD"));
            formData.append("date2", end.format("YYYY-MM-DD"));
            $.ajax({
                url : "index.php?r=action%2Fget-specific-data",
                type : "post",
                data: formData,
                processData: false,
                contentType: false,
                success : (data) => {
                    $("#clearTable").slideDown();
                    $("#table").slideDown();
                    document.querySelector("#tbody").innerHTML = "";
                    let no = 1;
                    let total = 0;
                    data.data.forEach((spp) => {
                        total += parseInt(spp.nominal);
                        let tr = document.createElement("tr");
                        let tdNo = document.createElement("td");
                        tdNo.innerHTML = no;
                        let tdDate = document.createElement("td");
                        tdDate.innerHTML = spp.created_at;
                        let tdPrice = document.createElement("td");
                        tdPrice.innerHTML = "Rp."+spp.nominal;
                        tr.append(tdNo);
                        tr.append(tdDate);
                        tr.append(tdPrice);
                        no++;
                        document.querySelector("#tbody").append(tr);
                    });
                    let tr = document.createElement("tr");
                    let thTotalText = document.createElement("th");
                    thTotalText.setAttribute("colspan", "2");
                    thTotalText.setAttribute("class", "pl-3");
                    thTotalText.innerHTML = "Jumlah";
                    let thTotal = document.createElement("th");
                    thTotal.innerHTML = "Rp."+total;
                    tr.append(thTotalText);
                    tr.append(thTotal);
                    document.querySelector("#tbody").append(tr);
                }
            });
        });
        $("#datepicker").val("");
        $("#datepicker").attr("placeholder", "Tanggal Pembayaran...");
    $("#popover").popover("show");

    $("#clearTable").click(() => {
        $("#tbody").html("");
        $("#table").slideUp();
        $("#clearTable").slideUp();
    });

    $("#findAll").click(() => {
        $("#table").slideUp();
        let formData = new FormData;
        $.ajax({
            url : "index.php?r=action%2Fget-all-data",
            type : "post",
            data: formData,
            processData: false,
            contentType: false,
            success : (data) => {
                $("#table").slideDown();
                $("#clearTable").slideDown();
                document.querySelector("#tbody").innerHTML = "";
                let no = 1;
                let total = 0;
                
                data.data.forEach((spp) => {
                    total += parseInt(spp.nominal);
                    let tr = document.createElement("tr");
                    let tdNo = document.createElement("td");
                    tdNo.innerHTML = no;
                    let tdDate = document.createElement("td");
                    tdDate.innerHTML = spp.created_at;
                    let tdPrice = document.createElement("td");
                    tdPrice.innerHTML = "Rp." + number_format(spp.nominal);
                    tr.append(tdNo);
                    tr.append(tdDate);
                    tr.append(tdPrice);
                    no++;
                    document.querySelector("#tbody").append(tr);
                });
                let tr = document.createElement("tr");
                let thTotalText = document.createElement("th");
                thTotalText.setAttribute("colspan", "2");
                thTotalText.setAttribute("class", "pl-3");
                thTotalText.innerHTML = "Jumlah";
                let thTotal = document.createElement("th");
                thTotal.innerHTML = "Rp." + number_format(total);
                tr.append(thTotalText);
                tr.append(thTotal);
                document.querySelector("#tbody").append(tr);
            }
        });
    });
    });', \yii\web\View::POS_READY
);