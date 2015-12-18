var input_text = "Please enter ";
var select_text = "Please select ";
var lbl_text = "";
$(function() {

    /* CATEGORY VALIDATION */
    $("#btn_category").click(function() {
        resetFormError();
        if ($("#cat_name").val() == "") {
            $("#cat_name").closest("div").addClass("has-error");
            lbl_text = $("#cat_name").siblings(".control-label").html();
            $("#cat_name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#cat_name").focus();
            return false;
        }
    });
    $(".btn_activeEntity").click(function() {
        var buttonObj = $(this);
        var entity = buttonObj.attr("entity");
        var entity_id = buttonObj.attr(entity + "-id");
        var active_val = buttonObj.attr(entity + "-active");
        var controller = buttonObj.attr("contrlr");
        $.ajax({
            url: base_url + controller + "/active",
            type: "POST",
            data: {
                "entity_id": entity_id,
                "active": active_val
            },
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.status) {
                    buttonObj.removeClass("btn-danger").addClass("btn-success");
                    buttonObj.text("Active");
                    buttonObj.attr(entity + "-active", "1");
                } else {
                    buttonObj.removeClass("btn-success").addClass("btn-danger");
                    buttonObj.text("InActive");
                    buttonObj.attr(entity + "-active", "0");
                }
            }
        });
    });

    /* PRODUCT VALIDATION */
    $(".cat_hierarchy").click(function() {
        var chkObj = $(this);
        var cat_level = parseInt(chkObj.attr("level")) + 1;
        var padding_left = 20;
        if (chkObj.is(":checked")) {
            $.ajax({
                url: base_url + "products/getSubcategory",
                type: "POST",
                data: {
                    "cat_id": chkObj.val(),
                    "cat_level": cat_level
                },
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.content != '') {
                        var innerDisp = padding_left * cat_level;
                        chkObj.parent().append('<div class="subcat_hierarchy" style="padding-left:' + innerDisp + 'px">' + response.content + '</div>');
                        chkObj.siblings(".subcat_hierarchy").slideToggle();
                    }
                }
            });
        } else {
            chkObj.siblings(".subcat_hierarchy").slideToggle("slow", function() {
                $(this).remove();
            });
        }
    });
    $("#btn_product").click(function() {
        resetFormError();
        if ($("#pro_name").val() == "") {
            $("#pro_name").closest("div").addClass("has-error");
            lbl_text = $("#pro_name").siblings(".control-label").html();
            $("#pro_name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#pro_name").focus();
            return false;
        }
        if ($("#short_description").val() == "") {
            $("#short_description").closest("div").addClass("has-error");
            lbl_text = $("#short_description").siblings(".control-label").html();
            $("#short_description").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#short_description").focus();
            return false;
        }
    });
    $("#btn_singleupload").click(function() {
        var featured_image = $("#image").val();
        if (featured_image == "") {
            $("#image").closest("div").addClass("has-error");
            $("#image").siblings(".help-block").html("Please select image.");
            $("#image").focus();
            return false;
        }
        if (featured_image != "")
        {
            var str_leng = featured_image;
            var len1 = str_leng.length;
            var f = str_leng.substr(len1 - 3, len1);
            if (!(f == "gif" || f == "jpg" || f == "JPG" || f == "GIF" || f == "PNG" || f == "png" || f == "jpeg"))
            {
                $("#image").closest("div").addClass("has-error");
                $("#image").siblings(".help-block").html("Allowed types: .gif, .jpg, .png, .jpeg");
                $("#image").focus();
                return false;
            }
        }
    });

    $(".edit_image_properties").click(function() {
        var pro_img_id = $(this).closest("p").attr("pro_img_id");
        $.ajax({
            url: base_url + "products/editImageProperties",
            type: "POST",
            data: {
                "pro_img_id": pro_img_id
            },
            beforeSend: function() {
                $("#editImageProperties .modal-body").html('<div align="center" style="line-height:180px"><img src="' + base_url_front + 'images/admin/loader_big.gif" alt="Wait"/>');
            },
            success: function(data) {
                var response = $.parseJSON(data);
                if (response.content != '') {
                    $("#editImageProperties .modal-body").html(response.content);
                }
            }
        });
    });
    $(document.body).on("click", "#saveImageProperties", function() {
        resetFormError();
        if ($("#caption").val() == "") {
            $("#caption").closest("div").addClass("has-error");
            lbl_text = $("#caption").siblings(".control-label").html();
            $("#caption").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#caption").focus();
            return false;
        }
        $.ajax({
            url: base_url + "products/saveImageProperties",
            type: "POST",
            data: {
                "pro_img_id": $("#pro_img_id").val(),
                "caption": $("#caption").val(),
                "short_description": $("#short_description").val(),
                "long_description": $("#long_description").val()
            },
            success: function(data) {
                var pro_img_id = $("#pro_img_id").val();
                $('#sort_images li[image_id="' + pro_img_id + '"]').find(".panel-heading").text($("#caption").val());
                $('#editImageProperties').modal('hide');
            }
        });
    });

    $(".delImageConfirm").click(function() {
        var pro_img_id = $(this).closest("p").attr("pro_img_id");
        var obj = $(this);
        var confirm_msg = "Are you sure you want to delete this image?";
        if (obj.attr("delete") == "0") {
            confirm_msg = "Are you sure you want to reset back this image?";
        }
        if (confirm(confirm_msg)) {
            $.ajax({
                url: base_url + "products/deleteImageById",
                type: "POST",
                data: {
                    "pro_img_id": pro_img_id,
                    "delete": obj.attr("delete")
                },
                success: function(data) {
                    var response = $.parseJSON(data);
                    obj.attr("delete", response.delete);
                    if (obj.find("i").hasClass("fa-repeat")) {
                        obj.find("i").removeClass("fa-repeat").addClass("fa-times").attr("title", "Delete");
                        obj.closest(".summary").find(".deleted_status").removeClass("red").html("No");
                    }
                    else if (obj.find("i").hasClass("fa-times")) {
                        obj.find("i").removeClass("fa-times").addClass("fa-repeat").attr("title", "Reset");
                        obj.closest(".summary").find(".deleted_status").addClass("red").html("Yes");
                    }
                }
            });
        }
        return false;
    });

    $("#btn_page").click(function() {
        resetFormError();
        if ($("#page_name").val() == "") {
            $("#page_name").closest("div").addClass("has-error");
            lbl_text = $("#page_name").siblings(".control-label").html();
            $("#page_name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#page_name").focus();
            return false;
        }
        if ($("#page_title").val() == "") {
            $("#page_title").closest("div").addClass("has-error");
            lbl_text = $("#page_title").siblings(".control-label").html();
            $("#page_title").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#page_title").focus();
            return false;
        }
        if ($("#page_url").val() == "") {
            $("#page_url").closest("div").addClass("has-error");
            lbl_text = $("#page_url").siblings(".control-label").html();
            $("#page_url").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#page_url").focus();
            return false;
        }
        /*if ($("#content").val() == "") {
         $("#content").closest("div").addClass("has-error");
         lbl_text = $("#content").siblings(".control-label").html();
         $("#content").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
         $("#content").focus();
         return false;
         }*/
    });

    $("#btn_banner").click(function() {
        resetFormError();
        var mode = $("#mode").val();
        if ($("#name").val() == "") {
            $("#name").closest("div").addClass("has-error");
            lbl_text = $("#name").siblings(".control-label").html();
            $("#name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#name").focus();
            return false;
        }
        var featured_image = $("#image").val();
        if (featured_image == "" && mode == "add") {
            $("#image").closest("div").addClass("has-error");
            $("#image").siblings(".help-block").html("Please select image.");
            $("#image").focus();
            return false;
        }
        if (featured_image != "")
        {
            var str_leng = featured_image;
            var len1 = str_leng.length;
            var f = str_leng.substr(len1 - 3, len1);
            if (!(f == "gif" || f == "jpg" || f == "JPG" || f == "GIF" || f == "PNG" || f == "png" || f == "jpeg"))
            {
                $("#image").closest("div").addClass("has-error");
                $("#image").siblings(".help-block").html("Allowed types: .gif, .jpg, .png, .jpeg");
                $("#image").focus();
                return false;
            }
        }
    });
    
    $("#btn_testimonial").click(function() {
        resetFormError();
        var mode = $("#mode").val();
        if ($("#name").val() == "") {
            $("#name").closest("div").addClass("has-error");
            lbl_text = $("#name").siblings(".control-label").html();
            $("#name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#name").focus();
            return false;
        }
        if ($("#company_name").val() == "") {
            $("#company_name").closest("div").addClass("has-error");
            lbl_text = $("#company_name").siblings(".control-label").html();
            $("#company_name").siblings(".help-block").html(input_text + lbl_text.toLowerCase());
            $("#company_name").focus();
            return false;
        }
        var featured_image = $("#image").val();
        /*if (featured_image == "" && mode == "add") {
            $("#image").closest("div").addClass("has-error");
            $("#image").siblings(".help-block").html("Please select image.");
            $("#image").focus();
            return false;
        }*/
        if (featured_image != "")
        {
            var str_leng = featured_image;
            var len1 = str_leng.length;
            var f = str_leng.substr(len1 - 3, len1);
            if (!(f == "gif" || f == "jpg" || f == "JPG" || f == "GIF" || f == "PNG" || f == "png" || f == "jpeg"))
            {
                $("#image").closest("div").addClass("has-error");
                $("#image").siblings(".help-block").html("Allowed types: .gif, .jpg, .png, .jpeg");
                $("#image").focus();
                return false;
            }
        }
    });
});

function resetFormError() {
    $(".form-group").removeClass("has-error");
    $(".help-block").html("");
}

function deleteConfirm(entityName, entityType, del_id) {
    if (confirm("Are you sure you want to delete this " + entityName + "?")) {
        window.location = base_url + entityType + "/delete/" + del_id;
    }
}

function deleteConfirmImage(pro_id) {
    if (confirm("Are you sure you want to delete all images of this product?")) {
        window.location = base_url + "products/deleteImage/" + pro_id;
    }
}