$("thead").keypress(function (event) { 
if (event.which == 13) { 
$("#btnSearch").click(); 
return false; 
} 
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
function checkSearch(url) {
    var search_value = document.getElementsByClassName("search-value");
    var chuyen = url + "?search=";
    var dem = 0;
    for (var i = 0; i < search_value.length; i++) {
        if (search_value[i].value != "") {
            dem++;
            if (dem > 1)
                chuyen += ";";
            chuyen += search_value[i].name + ":" + search_value[i].value;
        }
    }
    window.location.replace(chuyen);
}
$(document).ready(function () {

});
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
