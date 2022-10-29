<script type="text/javascript">
    $(document).ready(function() {
        $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
            return {
                "iStart": oSettings._iDisplayStart,
                "iEnd": oSettings.fnDisplayEnd(),
                "iLength": oSettings._iDisplayLength,
                "iTotal": oSettings.fnRecordsTotal(),
                "iFilteredTotal": oSettings.fnRecordsDisplay(),
                "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
            };
        };
        
        // view data pelanggan
        $('#pelanggan').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat.....",
                "searchPlaceholder": "Kata Kunci..."
            },
            "serverSide": true,
            "ajax": "pelanggan_datatables.php",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "kode_pelanggan"},
                {"data": "nama"},
                {"data": "tipe_mobil"},
                {"data": "nopol"},
                {"data": "alamat"},
                {"data": "telepon"},
                {"data": "created_at"},
                {"data": "action"}
            ],
            "order": [[7, 'desc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // view data transaksi
        $('#transaksi').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "transaksi_datatables.php",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "kode_pelanggan"},
                {"data": "nama_pelanggan"},
                {"data": "tipe_mobil"},
                {"data": "nopol"},
                {"data": "nama_user"},
                {"data": "tanggal"},
                {"data": "created_at"},
                {"data": "action"}
            ],
            "order": [[7, 'desc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        // view data user
        $('#user').DataTable({
            "processing": true,
            "language": {
                "processing": "Sedang memuat....."
            },
            "serverSide": true,
            "ajax": "user_datatables.php",
            "columns": [
                {
                    "data": null,
                    "orderable": true
                },
                {"data": "username"},
                {"data": "nama_user"},
                {"data": "level"},
                {"data": "status"},
                {"data": "action"}
            ],
            "order": [[1, 'asc']],
            "rowCallback": function (row, data, iDisplayIndex) {
                var info = this.fnPagingInfo();
                var page = info.iPage;
                var length = info.iLength;
                var index = page * length + (iDisplayIndex + 1);
                $('td:eq(0)', row).html(index);
            }
        });

        $("#errorMessage").alert().delay(4000).slideUp('slow');
        $("#successMessage").alert().delay(4000).slideUp('slow');
    });
</script>
<script>
    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })

    //Timepicker
    $('.timepicker').timepicker({
      showInputs: false
    })

    function get_paket(){
        $.ajax({
            type: "GET", 
            url: "get_data.php",
            data: {id_paket : $("#paket").val(), id_paket2 : $("#paket2").val()},
            dataType: "json",
            beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response){
                if(response.status == "success"){
                    // If status response is success, fill in the required data
                    $("#biaya").val(response.biaya);
                    var myStr = $("#biaya").val();
                    var myStr2 = myStr.split(' ');
                    var myStr3 = myStr2[1];
                    var myStr4 = myStr3.split('.');
                    var biaya = parseFloat(myStr4[0] + myStr4[1]);
                    var myStr5 = $("#bayar").val();
                    var myStr6 = myStr5.split('.');
                    var bayar = parseFloat(myStr6[0] + myStr6[1]);
                    var hasil = bayar - biaya;
                    hasil = addPeriod(hasil);
                    $("#kembali").val(hasil);
                    $("#total").val(myStr);
                } else if(response.status == "failed"){
                    // If status response is failed, call function modal infoConfirm and set value to empty
                    infoConfirm();
                    $("#biaya").val('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });
    }

    function get_pelanggan(){
        $.ajax({
            type: "GET", 
            url: "get_data.php",
            data: {kode_pelanggan : $("#nama_pelanggan").val()},
            dataType: "json",
            beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response){
                if(response.status == "success"){
                    // If status response is success, fill in the required data
                    $("#tipe_mobil").val(response.tipe_mobil);
                    $("#nopol").val(response.nopol);
                }else if(response.status == "failed"){
                    // If status response is failed, call function modal infoConfirm and set value to empty
                    infoConfirm();
                    $("#tipe_mobil").val('');
                    $("#nopol").val('');
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.responseText);
            }
        });
    }

    function addPeriod(nStr) {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + '.' + '$2');
        } 
        return x1 + x2;
    }

    function infoConfirm() {
        alert('Data tidak ditemukan atau Anda belum memilih paket pertama.');
    }

    $(document).ready(function(){
        $('#h_paket').keyup(function() {
            $('.h_paket').mask('000.000', {reverse: true});
        });

        $("#paket").change(function(){
            get_paket();  
        });

        $("#paket2").change(function(){
            get_paket();  
        });

        $("#nama_pelanggan").change(function(){
            get_pelanggan();  
        });

        $("#bayar").keyup(function(){
            $('.mata-uang').mask('000.000', {reverse: true});
            var myStr = $("#biaya").val();
            var myStr2 = myStr.split(' ');
            var myStr3 = myStr2[1];
            var myStr4 = myStr3.split('.');
            var biaya = parseFloat(myStr4[0] + myStr4[1]);
            var myStr5 = $("#bayar").val();
            var myStr6 = myStr5.split('.');
            var bayar = parseFloat(myStr6[0] + myStr6[1]);
            var hasil = bayar - biaya;
            hasil = addPeriod(hasil);
            $("#kembali").val(hasil);
            $("#total").val(myStr);
        });

        $('.hint').hide();

        $("#button").click(function(){
            $('.hint').show('slow');
        });
    });
</script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>