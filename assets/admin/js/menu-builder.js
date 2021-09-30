function disableWithUrl() {
    "use strict";
    $("#withUrl input").removeClass('item-menu');
    $("#withUrl select").removeClass('item-menu');
}

function enableWithUrl() {
    "use strict";
    $("#withUrl input").addClass('item-menu');
    $("#withUrl select").addClass('item-menu');
}

function disableWithoutUrl() {
    "use strict";
    $("#withoutUrl input").removeClass('item-menu');
    $("#withoutUrl select").removeClass('item-menu');
}

function enableWithoutUrl() {
    "use strict";
    $("#withoutUrl input").addClass('item-menu');
    $("#withoutUrl select").addClass('item-menu');
}

(function ($) {
    "use strict";

    // menu items
    var arrayjson = prevMenus;
    
    // icon picker options
    var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
    // sortable list options
    var sortableListOptions = {
        placeholderCss: {'background-color': "#cccccc"}
    };
    
    var editor = new MenuEditor('myEditor', {
        listOptions: sortableListOptions,
        iconPicker: iconPickerOptions,
        maxLevel: 1
    });
    editor.setForm($('#frmEdit'));
    editor.setUpdateButton($('#btnUpdate'));
    
        editor.setData(arrayjson);
    
        $('#btnOutput').on('click', function () {
            var str = editor.getString();
            let fd = new FormData();
            fd.append('str', str);
            fd.append('language_id', langid);
    
            $.ajax({
                url: menuUpdate,
                type: 'POST',
                data: fd,
                contentType: false,
                processData: false,
                success: function(data) {
                    if(data.status == 'error') {
                        bootnotify(data.message, 'Warning!', 'warning');
                    } else {
                        bootnotify(data.message, 'Success!', 'success');
                    }
                }
            });
        });
    
        $("#btnUpdate").on('click', function(){
            disableWithoutUrl();
            editor.update();
            enableWithoutUrl();
        });
    
        $('#btnAdd').on('click', function(){
            disableWithoutUrl();
            $("input[name='type']").val('custom');
            editor.add();
            enableWithoutUrl();
        });
        /* ====================================== */
    
    
    
        // when menu is chosen from readymade menus list
        $(".addToMenus").on('click', function(e) {
            e.preventDefault();
            disableWithUrl();
            $("input[name='type']").val($(this).data('type'));
            $("#withoutUrl input[name='text']").val($(this).data('text'));
            $("#withoutUrl input[name='target']").val('_self');
            editor.add();
            enableWithUrl();
    
    
    
        });
})(jQuery);