$(document).ready(function(){
	// $('[data-toggle="tooltip"]').tooltip();
    var actions = 
        '<a class="add" title="Add" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>' +
        '<a class="edit" title="Edit" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
        '<a class="delete" title="Delete" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>';
    // Show table
    show();
    function show(){
        $.ajax({
            url: 'Crud/list_emp',
            type: 'AJAX',
            dataType : 'JSON',
        }).done(function(data){
            let result = "";
            data.forEach(myFunction);

            function myFunction(value, index, array) {
                result += 
                    '<tr id="' + value['emp_id'] + '">' +
                        '<td>' + value['fname'] + '</td>' +
                        '<td>' + value['lname'] + '</td>' +
                        '<td>' + value['tel'] + '</td>' +
                        '<td>' + actions + '</td>' +
                    '</tr>';
            }
            $('#list-emp').html(result);
        });
    }
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = 
            '<tr class="add-emp">' +
                '<td><input type="text" class="form-control" name="fname" ></td>' +
                '<td><input type="text" class="form-control" name="lname" ></td>' +
                '<td><input type="text" class="form-control" name="tel" ></td>' +
                '<td>' + actions + '</td>'
            '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        // $('[data-toggle="tooltip"]').tooltip();
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
        var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
			if(!$(this).val()){
				$(this).addClass("error");
				empty = true;
			} else{
                $(this).removeClass("error");
            }
		});
		$(this).parents("tr").find(".error").first().focus();
		if (!empty) {
            var fname = $(this).parents("tr").find("td:nth-child(1) input[type=text]").val();
            var lname = $(this).parents("tr").find("td:nth-child(2) input[type=text]").val();
            var tel = $(this).parents("tr").find("td:nth-child(3) input[type=text]").val();
            if ($(this).parents("tr").attr("class") == 'add-emp') {
                $.ajax({
                    url: 'Crud/add_emp',
                    type: 'POST',
                    data: 'fname=' + fname + '&lname=' + lname + '&tel=' + tel,
                });
            } else {
                var id = $(this).parents("tr").attr("id");
                $.ajax({
                    url: 'Crud/edit_emp',
                    type: 'POST',
                    data: 'id=' + id + '&fname=' + fname + '&lname=' + lname + '&tel=' + tel,
                });
            }
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}		
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});		
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        var id = $(this).parents("tr").attr("id");
        $.ajax({
            url: 'Crud/del_emp',
            type: 'POST',
            data: 'id=' + id,
        });
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});