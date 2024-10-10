const article = $('.dataTable')
const articleUrl = `${BASE_URL}/api/article`
const addButton = $('#buttonAdd')
const modalTitle = $('.title')
const submitButton = $('#submit-button')


const formConfig = {
    fields: [
        {
            id: 'title',
            name: 'title'
        },
        {
            id: 'image',
            name: 'Gambar'
        },
        {
            id: 'content',
            name: 'kontent'
        },
    ]
}


const getInitData = () => {
    article.DataTable({
        processing: true,
        serverSide: true,
        ajax: `${BASE_URL}/api/article-data`,
        columns: [
            {
                data: 'title', 
                name: 'title',
                render: function(data, type, full, meta) {
                    return data.length > 20 ? data.substr(0, 20) + '...' : data;
                }
            },
            {
                data: 'content', 
                name: 'content',
                render: function(data, type, full, meta) {
                    return data.length > 20 ? data.substr(0, 20) + '...' : data;
                }
            },
            {
                data: 'image', 
                name: 'image',
                render: function(data, type, full, meta) {
                    return `<img src="${data}" alt="Image" style="width: 100px; height: auto;" />`;
                },
                orderable: false, 
                searchable: false  
            },
            {data: 'aksi', name: 'aksi'},
        ]
    });
}


$(function () {
    getInitData()
})

const resetForm = () => formConfig.fields.forEach(({id}) => $(`#${id}`).val(''))

$(function () {
    addButton.on('click', function () {
        modalTitle.text('Tambah artikel')
        submitButton.text('Tambah')
        resetForm()
        $('#addArticleButton').modal('show');
    })

    $('#addArticleButton').on('hidden.bs.modal', function () {
        resetForm();
        $(this).find('.invalid-feedback').text('');
    });
})

submitButton.on('click', function () {
    const id = $('#id').val()
    $(this).text().toLowerCase() === "ubah" ? update(id) : store()
})

const store = () => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: articleUrl,
        method: 'POST',
        dataType: 'json',
        data: dataFormStore(),
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addArticleButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(article);
        },
        error: ({responseJSON}) => {
            handleError(responseJSON);
        }
    });
}

const update = id => {
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: `${articleUrl}/${id}`,
        method: 'POST',
        dataType: 'json',
        data: dataFormEdit(id),
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        success: res => {
            $('#addArticleButton').modal('hide');
            resetForm();
            toastr.success(res.message, 'Success');
            reloadDatatable(article);
        },
        error: ({responseJSON}) => {
            handleError(responseJSON);
        }
    });
}

const dataFormStore = () => {
    const formData = new FormData();
    const title = $('#title').val();
    const content = $('#content').val();

    console.log("Title: ", title);
    console.log("Content: ", content);

    formData.append('title', title);
    formData.append('content', content);

    const fileInput = $('#image')[0].files[0];
    if (fileInput) {
        formData.append('image', fileInput);
    }

    return formData;
} 

const dataFormEdit = id => {
    const formData = new FormData();
    const title = $('#title').val();
    const content = $('#content').val();

    console.log("Title: ", title);
    console.log("Content: ", content);

    formData.append('title', title);
    formData.append('content', content);

    const fileInput = $('#image')[0].files[0];
    if (fileInput) {
        formData.append('image', fileInput);
    }

    formData.append('_method', 'PUT');
    return formData;
}


const reloadDatatable = table => table.DataTable().ajax.reload(null, false);

const handleError = (responseJSON) => {
    const { errors } = responseJSON;
    formConfig.fields.forEach(({ id, name }) => {
        if (errors.hasOwnProperty(id)) {
            $(`#${id}`).addClass("is-invalid");
            $(`#${id}`).next('.invalid-feedback').text(errors[id][0]);
        } else {
            $(`#${id}`).removeClass('is-invalid').next('.invalid-feedback').text('');
        }
    });
}

$(document).on('click', '.btn-edit', function () {
    const articleId = $(this).data('id');

    $.ajax({
        url: `${articleUrl}/${articleId}`,
        method: 'GET',
        dataType: 'json',
        success: res => {
            $('#id').val(res.id);
            submitButton.text('Ubah');
            modalTitle.text('Ubah artikel');
            
            formConfig.fields.forEach(({ id }) => {
                const field = $(`#${id}`);
                if (field.attr('type') === 'file') return;
                field.val(res?.[id]);
            });
            $('#addArticleButton').modal('show');
        },
        error: err => {
            console.log(err);
        }
    });
});



$(document).on('click', '.btn-delete', function () {
    const id = $(this).data('id');
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    Swal.fire({
        title: 'Anda Yakin?',
        text: "Data yang dihapus tidak bisa dikembalikan",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Tidak',
        customClass: {
            confirmButton: 'btn btn-danger me-3 waves-effect waves-light',
            cancelButton: 'btn btn-label-secondary waves-effect'
        },
        buttonsStyling: false
    }).then(result => {
        if (result.value) {
            $.ajax({
                url: `${articleUrl}/${id}`,
                method: 'DELETE',
                dataType: 'JSON',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: res => {
                    toastr.success(res.message, 'Success');
                    reloadDatatable(article);
                },
                error: err => {
                        toastr.error('Gagal menghapus data. Silahkan coba lagi.', 'Error');
                }
            });
        }
    });
});


$(document).on('click', '.btn-detail', function () {
    const articleId = $(this).data('id');
    
    $.ajax({
        url: `${articleUrl}/${articleId}`,
        method: 'GET',
        success: function (res) {
            $('#modal-title').text(res.title);
            $('#modal-image').attr('src', res.image);
            $('#modal-content').text(res.content);
            $('#largeModal').modal('show');
        },
        error: function (err) {
            console.error("Gagal mengambil data artikel", err);
            toastr.error('Gagal mengambil data artikel.', 'Error');
        }
    });
});
