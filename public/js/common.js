function back() {
	window.history.back(1);
}

function checkEmail(email) {
	return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(email);
}

function checkTelephone(telephone) {
	return /^1[3|4|5|7|8]{1}[0-9]{9}$/.test(telephone);
}

function checkNum(obj) {
	var val = obj.value;
	while (!/^[0-9]*$/.test(val)) {
		val = val.replace(/[^0-9]+/, '');
	}
	obj.value = val;
}

function verify(type, val) {
	switch (type) {
		case "telephone":
			return /^1[3|4|5|7|8]{1}[0-9]{9}$/.test(val);
			break;
		case "email":
			return /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/.test(val);
			break;
		case "number":
			if (!val) {
				return false;
			} else {
				return !isNaN(val);
			}
			break;
		case "float":
			return /^(-?\d+)(\.\d+)?$/.test(val);
			break;
		case "date":
			return /^(\d{4})[-\/](\d{1}|0\d{1}|1[0-2])([-\/](\d{1}|0\d{1}|[1-2][0-9]|3[0-1]))*$/.test(val);
			break;
		default:
			return false;
			break;
	}
}

function checkFloat(obj) {
	var str = obj.value;
	while (!/^[0-9.]*$/.test(str)) {
		str = str.replace(/[^0-9.]+/, '');
	}
	while (!/^[0-9]{1}[0-9.]*/.test(str)) {
		if (str.length == 0) { obj.value = ""; return; }
		str = str.substring(1);
	}
	str = str.split(".");
	if (str.length == 1) {
		obj.value = str[0];
	} else {
		obj.value = str[0] + "." + str[1];
	}
}

// function checkAll() {
// 	$("table .check").prop("checked", function (index, oldValue) {
// 		return !oldValue;
// 	});
// }

// 使用ajax来post数据（需引入jQuery）
function ajaxPost(url, data) {
	$.ajax({
		type: "post",
		url: url,
		dataType: "json",
		async: false,
		data: data,
		success: function (res) {
			alert(res.msg);
			if (res.stat == 0) {
				location.href = location.href;
			}
		},
		error: function (e) {
			alert("网络错误");
		}
	});
}

function deleteOne(url, id, token) {
	if (!window.confirm("确定删除所选信息？")) {
		return false;
	}
	ajaxPost(url, {
		"id": id,
		"_token": token
	});
}

function deleteSelected(url, token) {
	var id = getSelected();
	if (id == false) {
		return false;
	}
	deleteOne(url, id, token);
}

function getSelected() {
	var checkbox = $("input[name='id']");
	var id = '';
	for (var i = 0; i < checkbox.length; i++) {
		if (checkbox[i].checked) {
			id += checkbox[i].value + ",";
		}
	}
	if (id.length == 0) {
		alert("请选择有效信息");
		return false;
	}
	return id;
}

$(function () {
	/*
	 * 前台
	 */
	var html_height = parseInt($("html").css("height"));
	var header_height = $(".header").outerHeight(true);
	var footer_height = $(".footer").outerHeight(true);
	var content_margins = parseInt($(".content").css("margin-top")) + parseInt($(".content").css("margin-bottom"));
	var content_paddings = parseInt($(".content").css("padding-top")) + parseInt($(".content").css("padding-bottom"));
	console.log(content_margins);
	var height = html_height - header_height - footer_height - content_margins - content_paddings;
	$(".content").css({ "min-height": height + "px" });

	/*
	 * 后台
	 */
	var e_tr = $(".main-table tbody tr");
	for (var i = 0; i < e_tr.length; i++) {
		if (i % 2 != 0) {
			$(e_tr[i]).css({ "background": "#ECECEC" });
		}
	}

	// 列表checkbox选择
	$("input[name='id']").on("click", function () {
		if ($(this).is(":checked")) {
			$(this).attr("checked", "checked");
		} else {
			$(this).removeAttr("checked");
			$("input[name='dataid']").removeAttr("checked");// 若不选中，则把全局checkbox设为不选中
		}
	});

	// 全局checkbox选择，用于全（不）选
	$("input[name='dataid']").on('click', function () {
		if ($(this).is(":checked")) {
			$("input[name='id']").attr("checked", "checked");
		} else {
			$("input[name='id']").removeAttr("checked");
		}
	});
});