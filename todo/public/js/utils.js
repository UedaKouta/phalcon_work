
var Profile = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        $("#profileForm")[0].submit();
    }
};

var SignUp = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (SignUp.check("name") == false) {
            return false;
        }
        if (SignUp.check("username") == false) {
            return false;
        }
        if (SignUp.check("email") == false) {
            return false;
        }
        if (SignUp.check("password") == false) {
            return false;
        }
        if ($("#password")[0].value != $("#repeatPassword")[0].value) {
            $("#repeatPassword")[0].focus();
            $("#repeatPassword_alert").show();

            return false;
        }
        $("#registerForm")[0].submit();
    }
}
/* 
2020/07/08  Add TodoTitle function by todo
 */
var TodoTitle = {
    check: function (id) {
        if ($.trim($("#" + id)[0].value) == '') {
            $("#" + id)[0].focus();
            $("#" + id + "_alert").show();

            return false;
        };

        return true;
    },
    validate: function () {
        if (TodoTitle.check("title") == false) {
            return false;
        }

        $("#todosForm")[0].submit();
    }
}

$(document).ready(function () {
    $("#registerForm .alert").hide();
    $("div.profile .alert").hide();
});


// //アップロードを許可する拡張子
// var allow_exts = new Array('jpg', 'jpeg', 'png');

// //アップロード予定のファイル名の拡張子が許可されているか確認する関数
// function checkExt(filename)
// {
// 	//比較のため小文字にする
// 	var ext = getExt(filename).toLowerCase();
// 	//許可する拡張子の一覧(allow_exts)から対象の拡張子があるか確認する
// 	if (allow_exts.indexOf(ext) === -1) return false;
// 	return true;
// }