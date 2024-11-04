$('#form-filter button[type="submit"]').on('click', function () {
    $('#form-filter').data('url', $(this).data('url'));
});

$('#form-filter').on('submit', function (e) {
    if ($(this)[0].checkValidity() === false) {
        e.preventDefault();
        e.stopPropagation();
    } else {
        $('#form-filter button[type="submit"]').attr('disabled', true);
        $.ajax({
            url: $(this).data('url'),
            type: 'POST',
            data: new FormData($(this)[0]),
            contentType: false,
            processData: false,
            beforeSend: function () {
                setTimeout(function () {
                    $('#modal-loader').modal('show');
                }, 100);
            },
            xhr: function () {
                var xhr = new XMLHttpRequest();
                xhr.responseType = 'blob';
                return xhr;
            },
            success: function (response, status, xhr) {
                var filename = "";
                var disposition = xhr.getResponseHeader('Content-Disposition');

                // Mencari nama file dari header Content-Disposition
                if (disposition && disposition.indexOf('attachment') !== -1) {
                    var filenameRegex = /filename[^;=\n]*=((['"]).*?\2|[^;\n]*)/;
                    var matches = filenameRegex.exec(disposition);
                    if (matches != null && matches[1]) filename = matches[1].replace(/['"]/g, '');
                }

                // Mendapatkan tipe konten dari respons
                var contentType = xhr.getResponseHeader('Content-Type');
                var blob = new Blob([response], { type: contentType });

                // Penanganan berdasarkan jenis konten
                if (contentType.toLowerCase().indexOf('application/pdf') !== -1) {
                    // Jika tipe konten adalah PDF, buka tab baru untuk melihat PDF
                    var fileUrl = window.URL ? window.URL.createObjectURL(blob) : window.webkitURL.createObjectURL(blob);
                    window.open(fileUrl, '_blank');
                } else {
                    // Jika bukan PDF, lakukan proses unduhan
                    if (typeof window.navigator.msSaveBlob !== 'undefined') {
                        // Internet Explorer
                        window.navigator.msSaveBlob(blob, filename);
                    } else {
                        // Bukan Internet Explorer
                        var downloadUrl = window.URL ? window.URL.createObjectURL(blob) : window.webkitURL.createObjectURL(blob);

                        if (filename) {
                            // Gunakan atribut HTML5 <a download> untuk menentukan nama file
                            var a = document.createElement("a");
                            if (typeof a.download === 'undefined') {
                                // Safari tidak mendukung atribut download, navigasi ke URL unduhan
                                window.location = downloadUrl;
                            } else {
                                // Mengatur atribute href dan download, dan melakukan klik pada elemen a
                                a.href = downloadUrl;
                                a.download = filename;
                                document.body.appendChild(a);
                                a.click();
                                document.body.removeChild(a);
                            }
                        } else {
                            // Jika tidak ada nama file, gunakan URL untuk mengunduh file
                            window.location = downloadUrl;
                        }

                        // Membersihkan URL object setelah beberapa saat
                        setTimeout(function () {
                            if (window.URL) {
                                window.URL.revokeObjectURL(downloadUrl);
                            } else {
                                window.webkitURL.revokeObjectURL(downloadUrl);
                            }
                        }, 100);
                    }
                }
            },
            error: function (error) {
                alert('Kesalahan Saat Export Data');
            }
        }).done(function () {
            $('#form-filter button[type="submit"]').removeAttr('disabled');
            setTimeout(function () {
                $('#modal-loader').modal('hide');
            }, 1000);
        }).fail(function () {
            $('#form-filter button[type="submit"]').removeAttr('disabled');
            $('#modal-loader').modal('hide');
        })

        return false;
    }

    $(this).addClass('was-validated');
});


function reload() {
    $.confirm({
        title: '',
        content: 'Terdapat kesalahan saat pengiriman data, Segarkan halaman ini?',
        icon: 'icon icon-all_inclusive',
        theme: 'supervan',
        closeIcon: true,
        animation: 'scale',
        type: 'orange',
        autoClose: 'ok|10000',
        escapeKey: 'cancelAction',
        buttons: {
            ok: {
                text: "ok!",
                btnClass: 'btn-primary',
                keys: ['enter'],
                action: function () {
                    document.location.reload();
                }
            },
            cancel: function () {
                console.log('the user clicked cancel');
            }
        }
    });
}