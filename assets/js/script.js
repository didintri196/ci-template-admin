var datawherekategori = []
var Crypt = {
    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
    encode: function(e) {
        var t = "";
        var n, r, i, s, o, u, a;
        var f = 0;
        e = Crypt._utf8_encode(e);
        while (f < e.length) {
            n = e.charCodeAt(f++);
            r = e.charCodeAt(f++);
            i = e.charCodeAt(f++);
            s = n >> 2;
            o = (n & 3) << 4 | r >> 4;
            u = (r & 15) << 2 | i >> 6;
            a = i & 63;
            if (isNaN(r)) { u = a = 64 } else if (isNaN(i)) { a = 64 }
            t = t + this._keyStr.charAt(s) + this._keyStr.charAt(o) + this._keyStr.charAt(u) + this._keyStr.charAt(a)
        }
        return t
    },
    decode: function(e) {
        var t = "";
        var n, r, i;
        var s, o, u, a;
        var f = 0;
        e = e.replace(/[^A-Za-z0-9\+\/\=]/g, "");
        while (f < e.length) {
            s = this._keyStr.indexOf(e.charAt(f++));
            o = this._keyStr.indexOf(e.charAt(f++));
            u = this._keyStr.indexOf(e.charAt(f++));
            a = this._keyStr.indexOf(e.charAt(f++));
            n = s << 2 | o >> 4;
            r = (o & 15) << 4 | u >> 2;
            i = (u & 3) << 6 | a;
            t = t + String.fromCharCode(n);
            if (u != 64) { t = t + String.fromCharCode(r) }
            if (a != 64) { t = t + String.fromCharCode(i) }
        }
        t = Crypt._utf8_decode(t);
        return t
    },
    _utf8_encode: function(e) {
        e = e.replace(/\r\n/g, "\n");
        var t = "";
        for (var n = 0; n < e.length; n++) {
            var r = e.charCodeAt(n);
            if (r < 128) { t += String.fromCharCode(r) } else if (r > 127 && r < 2048) {
                t += String.fromCharCode(r >> 6 | 192);
                t += String.fromCharCode(r & 63 | 128)
            } else {
                t += String.fromCharCode(r >> 12 | 224);
                t += String.fromCharCode(r >> 6 & 63 | 128);
                t += String.fromCharCode(r & 63 | 128)
            }
        }
        return t
    },
    _utf8_decode: function(e) {
        var t = "";
        var n = 0;
        var r = c1 = c2 = 0;
        while (n < e.length) {
            r = e.charCodeAt(n);
            if (r < 128) {
                t += String.fromCharCode(r);
                n++
            } else if (r > 191 && r < 224) {
                c2 = e.charCodeAt(n + 1);
                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                n += 2
            } else {
                c2 = e.charCodeAt(n + 1);
                c3 = e.charCodeAt(n + 2);
                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                n += 3
            }
        }
        return t
    }
}


function convertToRupiah(angka) {
    var rupiah = '';
    var angkarev = angka.toString().split('').reverse().join('');
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
    return 'Rp.' + rupiah.split('', rupiah.length - 1).reverse().join('');
}
var idkategori = "";
var periode = "";

function get_paket_kategori(id) {
    idkategori = id;
    periode = $("#periode").val();
    var html = "";
    $.ajax({
        url: "/api/paket/kategori/" + id + "/" + periode,
        dataType: "json",
        type: "GET",
        success: function(response) {
            console.log(response);
            datawherekategori = response;
            $.each(response, function(key, row) {
                // console.log(value);
                html += '<div class="col-md-6">';
                html += '<div class="media-list media-list-hover media-list-divided mb-3  bl-2 border-info card-shadowed">';
                html += '<div class="media media-single">';
                html += '<div class="media-body">';
                if (row.asrama == "TRUE") {
                    html += '<h5><a href="#">' + row.judul + ' — ' + row.nama_asrama + '</a></h5> <small>' + row.durasi + '</small>';
                } else {
                    html += '<h5><a href="#">' + row.judul + '</a></h5> <small>' + row.durasi + '</small>';
                }
                html += '</div>';
                html += '<div class="media-right">';
                html += '<button data-toggle="modal" data-target="#modal-center" class="btn btn-sm btn-bold btn-round btn-outline btn-info w-100px" onclick="getdetaildatapaket(';
                html += "'" + row.id + "')";
                html += '">' + convertToRupiah(row.harga) + '</button> ';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });
            $('#data' + id).html(html);
        },
        error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            // console.log(msg);
            alert(msg);
        },
    });
}

function get_paket_kategori_periode() {
    id = idkategori;
    periode = $("#periode").val();
    var html = "";
    $.ajax({
        url: "/api/paket/kategori/" + id + "/" + periode,
        dataType: "json",
        type: "GET",
        success: function(response) {
            console.log(response);
            datawherekategori = response;
            $.each(response, function(key, row) {
                // console.log(value);
                html += '<div class="col-md-6">';
                html += '<div class="media-list media-list-hover media-list-divided mb-3  bl-2 border-info card-shadowed">';
                html += '<div class="media media-single">';
                html += '<div class="media-body">';
                if (row.asrama == "TRUE") {
                    html += '<h5><a href="#">' + row.judul + ' — ' + row.nama_asrama + '</a></h5> <small>' + row.durasi + '</small>';
                } else {
                    html += '<h5><a href="#">' + row.judul + '</a></h5> <small>' + row.durasi + '</small>';
                }
                html += '</div>';
                html += '<div class="media-right">';
                html += '<button data-toggle="modal" data-target="#modal-center" class="btn btn-sm btn-bold btn-round btn-outline btn-info w-100px" onclick="getdetaildatapaket(';
                html += "'" + row.id + "')";
                html += '">' + convertToRupiah(row.harga) + '</button> ';
                html += '</div>';
                html += '</div>';
                html += '</div>';
                html += '</div>';
            });
            $('#data' + id).html(html);
        },
        error: function(jqXHR, exception) {
            var msg = '';
            if (jqXHR.status === 0) {
                msg = 'Not connect.\n Verify Network.';
            } else if (jqXHR.status == 404) {
                msg = 'Requested page not found. [404]';
            } else if (jqXHR.status == 500) {
                msg = 'Internal Server Error [500].';
            } else if (exception === 'parsererror') {
                msg = 'Requested JSON parse failed.';
            } else if (exception === 'timeout') {
                msg = 'Time out error.';
            } else if (exception === 'abort') {
                msg = 'Ajax request aborted.';
            } else {
                msg = 'Uncaught Error.\n' + jqXHR.responseText;
            }
            // console.log(msg);
            alert(msg);
        },
    });
}

function getdetaildatapaket(id) {
    $("#fasilitas_asrama").html("");
    $.each(datawherekategori, function(key, row) {
        if (row.id == id) {
            console.log(row);
            $("#modal-title").html(row.nama_kategori + " - " + row.judul);
            $("#durasi").html(row.durasi);
            //fasilitas kursus
            var html_kursus = "";
            var res = row.deskripsi_paket.split(",");
            $.each(res, function(key, value) {
                // console.log(value);
                html_kursus += "<li>" + value + "</li>";
            });
            $("#fasilitas_kursus").html(html_kursus);

            //fasilitas asrama
            var html_asrama = "";
            if (row.asrama == "TRUE") {
                $("#modal-title").html(row.nama_kategori + " - " + row.judul + "[" + row.nama_asrama + "]");
                $("#fasilitas_asrama").html("<h3> Fasilitas Asrama: </h3>");
                $.each(row.fasilitas_asrama, function(key, value_asrama) {
                    // console.log(value);
                    html_asrama += '<button class="btn btn-sm btn-bold btn-round btn-outline btn-info mb-1">' + value_asrama.fasilitas + '</button>';
                });
                $("#fasilitas_asrama").append(html_asrama);
            }
            var periode = $("#periode").val();
            var url = encodeURIComponent(Crypt.encode(row.id + "|" + periode));
            var html_button = '<a href="/account/register-paket/checkout/' + url + '?pay=dp" class="btn btn-sm btn-bold btn-round btn-warning m-1">BAYAR DP ' + convertToRupiah(row.dp) + '</a>';
            html_button += '<a href="/account/register-paket/checkout/' + url + '?pay=full" class="btn btn-sm btn-bold btn-round btn-success">BAYAR FULL ' + convertToRupiah(row.harga) + '</a>';
            $("#button_pay").html(html_button);
        }
    })
}

$("#validatePromoCode").click(function() {
    var code = $("#inputPromoCode").val();
    // alert(code);
    if (code == "") {
        alert("Kode masih kosong");
    } else {
        var hargaasli = $("#nominal_lunas").val();
        var dp = $("#nominal_dp").val();
        var status_pay = $("#status_pay").val();
        $.ajax({
            url: "/api/cek-coupon/" + code,
            dataType: "json",
            type: "GET",
            success: function(response) {
                console.log(response);
                if (response != null) {
                    $("#PromoCode").val(code);
                    if (response.status == "active") {
                        swal({
                            title: 'Sukses',
                            text: 'Berhasil menggunakan kode ' + code,
                            timer: 2000,
                            type: "success"
                        });
                        var diskon = 0;
                        if (response.tipe == "PERCENT") {
                            diskon = hargaasli * response.value / 100;
                        } else if (response.tipe == "NOMINAL") {
                            diskon = response.value;
                        }
                        var totalhargadiskon = hargaasli - diskon;

                        $("#nominal_akhir").html(convertToRupiah(totalhargadiskon));

                        if (status_pay == "dp") {
                            var totalhargadiskonmindp = totalhargadiskon - dp;
                            $("#nominal_selanjutnya").html(convertToRupiah(totalhargadiskonmindp));
                        } else if (status_pay == "full") {
                            // alert(totalhargadiskon);
                            $("#nominal_sekarang").html(convertToRupiah(totalhargadiskon));
                        }
                        $("#using_promote").html("<br><small>Using Promotion Code <b><i>" + code + "</i></b></small>");
                        $("#nominal_asli").show();
                        $("#deskripsi_promo").html("<h3><button class='btn btn-sm btn-bold btn-outline btn-round btn-success'><i> Using Coupon " + code + "</i></button><br> " + response.deskripsi + "</h3>");
                        $("#using_promote").html("<br><small>Using Promotion Code <b><i>" + code + "</i></b></small>");
                        $("#nominal_asli").show();
                        $("#deskripsi_promo").html("<h3><button type='button' class='btn btn-sm btn-bold btn-outline btn-round btn-success'><i> Using Coupon " + code + "</i></button><br> " + response.deskripsi + "</h3>");
                    } else if (response.status == "nonactive") {
                        swal({
                            title: 'Gagal',
                            text: 'Kode ' + code + ' sudah tidak aktif',
                            timer: 2000,
                            type: "error"
                        });
                    } else if (response.status == "expired") {
                        swal({
                            title: 'Gagal',
                            text: 'Kode ' + code + ' sudah kadaluwarsa',
                            timer: 2000,
                            type: "error"
                        });
                    } else if (response.status == "quota_needed") {
                        swal({
                            title: 'Gagal',
                            text: 'Quota kode ' + code + ' sudah full',
                            timer: 2000,
                            type: "error"
                        });
                    } else {
                        swal({
                            title: 'Gagal',
                            text: 'Terjadi kesalahan sistem',
                            timer: 2000,
                            type: "error"
                        });
                    }
                } else {
                    swal({
                        title: 'Gagal',
                        text: 'Kode ' + code + ' tidak ditemukan',
                        timer: 2000,
                        type: "error"
                    });
                }
            },
            error: function(jqXHR, exception) {
                var msg = '';
                if (jqXHR.status === 0) {
                    msg = 'Not connect.\n Verify Network.';
                } else if (jqXHR.status == 404) {
                    msg = 'Requested page not found. [404]';
                } else if (jqXHR.status == 500) {
                    msg = 'Internal Server Error [500].';
                } else if (exception === 'parsererror') {
                    msg = 'Requested JSON parse failed.';
                } else if (exception === 'timeout') {
                    msg = 'Time out error.';
                } else if (exception === 'abort') {
                    msg = 'Ajax request aborted.';
                } else {
                    msg = 'Uncaught Error.\n' + jqXHR.responseText;
                }
                // console.log(msg);
                alert(msg);
            },
        });
    }
});