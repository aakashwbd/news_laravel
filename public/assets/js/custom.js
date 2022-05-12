function itemStore(formData,options,url){
    $("#preloader").removeClass('d-none');
    $.ajax({
        url: url,
        type: 'POST',
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        success: function (res) {
            toastr.success('Item Create successfully', res, options);
            setTimeout(location.reload.bind(location), 1000);
        },
        error: function (jqXhr, ajaxOptions, thrownError) {
            if (jqXhr.status == 422) {
                $("#preloader").addClass('d-none');
                if(jqXhr.status == 422 &&  jqXhr.responseJSON.status == "error"){
                    toastr.error(jqXhr.responseJSON.message);
                }
                var errorsHtml = '';
                var errors = jqXhr.responseJSON.message;
                $.each(errors, function (key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
            } else if (jqXhr.status == 500) {
                toastr.error(jqXhr.responseJSON.message, '', options);
                $("#preloader").addClass('d-none');
            } else {
                toastr.error('Error', 'Something went wrong', options);
                $("#preloader").addClass('d-none');
            }
            App.unblockUI();
        }
    });
}
function fileUploader(formData,options,showurl){
    $("#preloader").removeClass('d-none');
    $.ajax({
        url: showurl,
        type: 'POST',
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization' : localStorage.getItem('token'),
        },
        data: formData,
        success: function(res) {
            $("#preloader").addClass('d-none');
            toastr.success('File Upload successfully');
            $("#imageUrl").val(res.data);
        },
        error: function(jqXhr, ajaxOptions, thrownError) {
            if (jqXhr.status == 422) {
                $("#preloader").addClass('d-none');
                var errorsHtml = '';
                var errors = jqXhr.responseJSON.message;
                $.each(errors, function(key, value) {
                    errorsHtml += '<li>' + value + '</li>';
                });
                toastr.error(errorsHtml, jqXhr.responseJSON.heading, options);
            } else if (jqXhr.status == 404) {
                toastr.error(jqXhr.responseJSON.message, '', options);
                $("#preloader").addClass('d-none');
            } else {
                toastr.error('Error', 'Something went wrong', options);
                $("#preloader").addClass('d-none');
            }
        }
    });
}
function deleteItem(url){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    setInterval(function(){
                        location.reload();
                    },1000)

                },
                error: function (xhr, resp, text) {
                    console.log("err",xhr);
                    if(xhr.status == 422 &&  xhr.responseJSON.status == "error"){
                        Swal.fire(
                            'Warning!',
                            xhr.responseJSON.message,
                            'error'
                        )
                    }
                    // on error, tell the failed
                },
            });


        }
    })
}
function approval(url,id,properties,options){
    $("#preloader").removeClass('d-none');
    $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            id: id,
            status: properties,
        },
        success: function (res) {
            console.log(res.success)
            if (res) {
                toastr.success('Successfully Update', );
                $("#preloader").addClass('d-none');
            }
        },
        error: function (jqXhr, ajaxOptions, thrownError) {
            if(jqXhr.status == 422 &&  jqXhr.responseJSON.status == "error"){
                toastr.error( jqXhr.responseJSON.message)
                $("#preloader").addClass('d-none');
            }
        }
    }); //ajax
}
