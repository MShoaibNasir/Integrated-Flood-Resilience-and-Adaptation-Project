var base_url='http://localhost/unknown/IFRAP/public/';
$(document).ready(function () {
   


    // filter lots
    $("#area").change(function () {
        var area = $("#area").val();
        console.log('area'+area);
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `${base_url}filter/lot`,
            data: {
                area: area,
                _token: token,
            },
            success: function (response) {
                console.log(response);
                $("#lot").empty(); // Clear existing options
                $("#lot").append(
                    "<option value='' selected disabled>Please Select Lot</option>"
                );
                response.forEach((lot) => {
                    console.log(lot);
                    
                    var id = lot["id"];
          
                    $("#lot").append(
                        "<option value='" +
                            id +
                            "'>" +
                            lot["name"] +
                            "</option>"
                    );
                });
            },
            error: function (request, status, error) {
                console.log(error);
                alert("Couldn't retrieve lots. Please try again later.");
            },
        });
    });

    // filter district
    $("#lot").change(function () {
        var lot_id = $("#lot").val();
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `${base_url}filter/districts`,
            data: {
                lot_id: lot_id,
                _token: token,
            },
            success: function (response) {
                console.log(response);
                $("#district").empty(); // Clear existing options
                $("#district").append(
                    "<option value='' selected disabled>Please Select District</option>"
                );
                response.forEach((district) => {
                    var id = district["id"];
                    $("#district").append(
                        "<option value='" +
                            id +
                            "'>" +
                            district["name"] +
                            "</option>"
                    );
                });
            },
            error: function (request, status, error) {
                console.log(error);
                alert("Couldn't retrieve districts. Please try again later.");
            },
        });
    });

    // filter tehsil
    $("#district").change(function () {
        var district_id = $("#district").val();
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `${base_url}filter/tehsil`,
            data: {
                district_id: district_id,
                _token: token,
            },
            success: function (response) {
                console.log(response);
                $("#tehsil").empty(); // Clear existing options
                $("#tehsil").append(
                    "<option value='' selected disabled>Please Select Tehsil</option>"
                );
                response.forEach((tehsil) => {
                    var id = tehsil["id"];
                    $("#tehsil").append(
                        "<option value='" +
                            id +
                            "'>" +
                            tehsil["name"] +
                            "</option>"
                    );
                });
            },
            error: function (request, status, error) {
                console.log(error);
                alert("Couldn't retrieve districts. Please try again later.");
            },
        });
    });
    // filter uc
    $("#tehsil").change(function () {
        var tehsil_id = $("#tehsil").val();
        var token = $('meta[name="csrf-token"]').attr("content");
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `${base_url}filter/uc`,
            data: {
                tehsil_id: tehsil_id,
                _token: token,
            },
            success: function (response) {
                console.log(response);
                $("#uc").empty(); // Clear existing options
                $("#uc").append(
                    "<option value='' selected disabled>Please Select Tehsil</option>"
                );
                response.forEach((uc) => {
                    var id = uc["id"];
                    $("#uc").append(
                        "<option value='" +
                            id +
                            "'>" +
                            uc["name"] +
                            "</option>"
                    );
                });
            },
            error: function (request, status, error) {
                console.log(error);
                alert("Couldn't retrieve districts. Please try again later.");
            },
        });
    });

    $('#generate_password').click(function(){
        var password='abcdefghijklmnopqrstuvwxyz1234567890!@#$%^&*()';
        var length=10;
        var generate_password='';
        var password_field=document.getElementById('password');
        for (let i = 0; i < length; i++) {
            generate_password += password.charAt(Math.floor(Math.random() * password.length));
        }
        password_field.type = 'text';
        password_field.value=generate_password;
       

    })
});
