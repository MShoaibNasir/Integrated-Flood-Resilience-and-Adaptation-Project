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
            <div class="mb-3 col-12">
                <label class="form-label">Placeholder</label>
                <textarea name="placeholder[]" class="form-control" rows="4"></textarea>
            </div>
            <div id="add_more_option_${j}"></div>
        </div>`;
    
    add_more_option.innerHTML = html;
}
