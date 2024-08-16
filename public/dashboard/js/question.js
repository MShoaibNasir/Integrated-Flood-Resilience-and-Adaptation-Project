function add_options(i) {
    var add_more_option = document.getElementById("add_more_option_" + i);
    var j = i + 1;
    var html = `
        <div class="col-12 d-flex justify-content-end">
            <a class="btn btn-danger" id="add_options_${j}" onclick="add_options(${j})">Add Options</a>
        </div>
        <div class="row">
            <div class="mb-3 col-6">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name[]">
            </div>
            <div class="mb-3 col-6">
                <label class="form-label">Type</label>
                <select name="type[]" class="form-control">
                    <option value="">Select Type</option>
                    <option value="radio">Radio Button</option>
                    <option value="text">Text</option>
                    <option value="date">Date</option>
                </select>
            </div>
            <div id="add_more_option_${j}"></div>
        </div>`;
    
    add_more_option.innerHTML = html;
}



var base_url='http://localhost/unknown/IFRAP/public/';
function showQuestion(id) {
    var token = $('meta[name="csrf-token"]').attr("content");
    $.ajax({
        type: "GET",
        dataType: "json",
        url: `${base_url}admin/question/filter`,
        data: {
            question_id: id,
            _token: token,
        },
        success: function (response) {
            console.log(response);
            $('#question_name').val(response.name);
        },
        error: function (request, status, error) {
            console.log(error);
            alert("Couldn't retrieve lots. Please try again later.");
        },
    });
}
function show_related_question() {
   
    var token = $('meta[name="csrf-token"]').attr("content");
    var option_id=$('#option_id').val();

    $.ajax({
        type: "GET",
        dataType: "json",
        url: `${base_url}admin/question/related`,
        data: {
            option_id: option_id,
            _token: token,
        },
        success: function (response) {
            console.log(response);
            $('#question_name_for_show').val(response.name);
        },
        error: function (request, status, error) {
            console.log(error);
            alert("Couldn't retrieve lots. Please try again later.");
        },
    });
}



