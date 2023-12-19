function uploadFile(formData) {
    let upload = [];
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        async: false,
        processData: false,
        contentType: false,
        type: "POST",
        dataType: "JSON",
        data: formData,
        url: "/upload",
        success: function (result) {
            upload = result;
        },
    });
    return upload;
}
