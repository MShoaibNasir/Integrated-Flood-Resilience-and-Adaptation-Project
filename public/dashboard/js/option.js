var base_url='http://localhost/unknown/IFRAP/public/';
function showOption(id) {
    var token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: `${base_url}admin/options/filter`,
        data: {
            option_id: id,
            _token: token,
        },
        success: function (response) {
            console.log(response);
            $('#option_name').val(response.name);
        },
        error: function (request, status, error) {
            console.log(error);
            alert("Couldn't retrieve lots. Please try again later.");
        },
    });
}
