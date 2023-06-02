$(document).ready(function () {


    // This function is user to insert data in database
    $("#btnSaveAction").on("click", function () {
        params = ""
        $("td[contentEditable='true']").each(function () {
            if ($(this).text() != "") {
                if (params != "") {
                    params += "&";
                }
                params += $(this).data('id') + "=" + $(this).text();
            }
        });
        if (params != "") {
            $.ajax({
                url: "function.php",
                type: "POST",
                data: params,
                success: function (response) {
                    $("#ajax-response").append(response);
                    $("td[contentEditable='true']").text("");
                }
            });
            return false;
        }
    });
    

    // This function is used for edit the row to make it editable
    $('#tbl').on('click', '.edit', function () {
        $('#tbl').find('.save, .cancel').hide();
        $('#tbl').find('.edit').show();
        $(this).hide().siblings('.save, .cancel').show();

        $(this).closest('td').siblings().each(
            function () {
                var inp = $(this).find('input');
                if (inp.length) {
                    $(this).text(inp.val());
                } else {
                    var t = $(this).text();
                    $(this).attr('contentEditable', 'true');
                }
            });
    });

    // This function is used for edit the row to make it editable
    $('#tbl').on('click', '.cancel', function () {
        $('#tbl').find('.save, .cancel').hide();
        $(this).hide().siblings('.edit').show();
        $(this).closest('td').siblings().each(
            function () {
                $(this).attr('contentEditable', 'false');
                location.reload();
            });
    });

    // This function is used for saving the edit data in database
    $('#tbl').on('click', '.save', function () {
        var $btn = $(this);
        $('#tbl').find('.save, .cancel').hide();
        $btn.hide().siblings('.edit').show();
        params = "";
        var id = $btn.data('id');
        $(this).closest('td').siblings().each(function () {
            $(this).attr('contentEditable', 'false');
            if (params != "") {
                params += "&";
            }
            params += $(this).data('id') + "=" + $(this).text();
        });
        params += "&id" + "=" + id;
        console.log(params);
        if (params != "") {
            $.ajax({
                url: "function.php",
                type: "POST",
                data: params,
                success: function (response) {
                    $("#ajax-response").append(response);
                    // $("td[contentEditable='true']").text("");
                }
            });
            return false;
        }
    });

    // this ajax is using for deleting the row 
    $('#tbl').on("click", ".del", function () {
        var el = this;

        var deleteid = $(this).data('id');

        console.log(deleteid);

        var confirmalert = confirm("Are you sure?");
        if (confirmalert == true) {
            $.ajax({
                url: 'function.php',
                type: 'POST',
                data: {
                    id: deleteid,
                    action: 'del'
                },
                success: function (response) {

                    if (response == 1) {
                        // Remove row from HTML Table
                        $(el).closest('tr').css('background', 'tomato');
                        $(el).closest('tr').fadeOut(800, function () {
                            $(this).remove();
                        });
                    } else {
                        alert('Invalid ID.');
                    }

                }
            });
        }

    });


});