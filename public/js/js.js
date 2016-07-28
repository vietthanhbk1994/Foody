$("img").each(function (index) {
    var src = "http://localhost/foody_new/public/uploads/";
    $('img[src="'+src+'"]').attr('src', src+"no-image.jpg");
});

$("body").on("submit", "form[name='delete']", function (e) {
    var form = this;
    e.preventDefault();
    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel plx!",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirmed) {
        if (isConfirmed) {
            swal({
                title: "Deleted!",
                text: "Your file has been deleted.",
                type: "success",
                showCancelButton: true,
                cancelButtonText: "Undo!",
                closeOnConfirm: false,
                showLoaderOnConfirm: true
            }, function () {
                form.submit();
            });
        } else {
            swal("Cancelled", "Your file is safe :)", "error");
        }
    });
});
//load xem truoc anh
function checkHinhAnh(input) {
    var reader = new FileReader();
    reader.onload = function (e) {
        var img = document.getElementById("img");
        img.src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
}/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
function checkImage(name) {
    //alert(name);
    var hinhAnh, msg = "";
    //check hinh anh
    hinhAnh = document.getElementsByName(name)[0];
    //alert(hinhAnh);
    if ('files' in hinhAnh) {
        //  alert(2);
//        if (hinhAnh.files.length == 1) {
//            var file = hinhAnh.files[0];
//        //    alert(4);
//            if ('size' in file) {
//                var sizeFile = file.size;
//                if (sizeFile > 1000) {//>2MB
//                    msg = "Size file > 1MB";
//                }
//            }
//            if ('name' in file) {
//                var nameFile = file.name;
//                var typeFile = nameFile.split('.')[nameFile.split('.').length - 1].toLowerCase();
//                if (!(typeFile == "jpg" || typeFile == "jpeg" || typeFile == "gif" || typeFile == "png")) {
//                    msg = "File must is image: .jpg, .jpeg, .gif, .png";
//                }
//          //      alert(3);
//            }
//            if (msg != "") {
//                var err = document.getElementById("my-error");
//                err.setAttribute( 'class', "alert alert-danger" );
//                err.innerHTML = msg;
//                return false;
//            }
//        }
    }
}