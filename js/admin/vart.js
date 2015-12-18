$(document).ready(function() {
    $("#sort_images").sortable({
        cursor: 'move',
        /*containment: 'parent',*/
        placeholder: "sortable-placeholder",
        revert: 300,
        handle: '.handle',
        start: function(event, ui) {
            ui.placeholder.height(ui.item.height());
            ui.placeholder.addClass('col-lg-3');
        },
        update: function(e, ui) {
            var sortOrderArr = Array();
            $.each($("#sort_images li"), function(ind, val) {
                var image_id = $(this).attr("image_id");
                sortOrderArr.push(image_id);
            });
            $.ajax({
                url: base_url + "products/saveSortOrder",
                "type": "POST",
                data: {
                    "pro_id": $("#pro_id").val(),
                    "img_ids": sortOrderArr
                },
                success: function(data) {
                    
                }
            })
        }
    });
});