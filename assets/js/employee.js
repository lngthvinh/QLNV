// Action Buttons
function actions() {
    var actions = 
        '<a class="add" title="Add" onclick="add(this)" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>' +
        '<a class="edit" title="Edit" onclick="edit(this)" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
        '<a class="delete" title="Delete" onclick="del(this)" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>';
    return actions;
}
// Show table
show();
function show() {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        var result = "";
        for (let item of response) {
            result += 
                '<tr id="' + item['employeeId'] + '">' +
                    '<td>' + item['firstName'] + '</td>' +
                    '<td>' + item['lastName'] + '</td>' +
                    '<td>' + item['telephone'] + '</td>' +
                    '<td>' + actions() + '</td>' +
                '</tr>';
        }
        document.getElementById('list-employee').innerHTML = result;
    }
    xhr.open("AJAX", "Employee/list_employee");
    xhr.send();
}
// Append table with add row form on add new button click
function add_new() {
    document.getElementById("add-new").disabled = true;
    var row = 
        '<td><input type="text" class="form-control" name="firstName" ></td>' +
        '<td><input type="text" class="form-control" name="lastName" ></td>' +
        '<td><input type="text" class="form-control" name="telephone" ></td>' +
        '<td>' + actions() + '</td>';
    var tableRef = document.getElementById("list-employee");
    var newRow = tableRef.insertRow(-1);
    newRow.id = 'add-employee';
    newRow.innerHTML = row;
    document.querySelectorAll("a.add")[tableRef.rows.length - 1].style.display = "inline";
    document.querySelectorAll("a.edit")[tableRef.rows.length - 1].style.display = "none";
}
// Add row on add button click
function add(x) {
    var empty = false;
    var input = document.querySelectorAll('input[type="text"]');
    for (let item of input) {
        if (!item.value) {
            item.classList.add("error");
            empty = true;
        } else {
            item.classList.remove("error");
        }
    }
    if (!empty) {
        var firstName = input[0].value;
        var lastName = input[1].value;
        var telephone = input[2].value;

        var id = x.parentElement.parentElement.id;
        if (id == "add-employee") {
            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var response = JSON.parse(this.responseText);
                var result = (response['firstName'] == firstName && response['lastName'] == lastName && response['telephone'] == telephone) 
                    ? "Add success" : "Add fail";
                alert(result);
                show();
            }
            xhr.open("POST", "Employee/add_employee");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("firstName=" + firstName + "&lastName=" + lastName + "&telephone=" + telephone);
        } else {
            const xhr = new XMLHttpRequest();
            xhr.onload = function() {
                var response = JSON.parse(this.responseText);
                var result = (response['employeeId'] == id && response['firstName'] == firstName && response['lastName'] == lastName && response['telephone'] == telephone) 
                    ? "Edit success" : "Edit fail";
                alert(result);
                show();
            }
            xhr.open("POST", "Employee/edit_employee");
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("id=" + id + "&firstName=" + firstName + "&lastName=" + lastName + "&telephone=" + telephone);
        }
        document.getElementById("add-new").removeAttribute("disabled");
    }
}
// Edit row on edit button click
function edit(x) {
    var id = x.parentElement.parentElement.id;
    var row = document.getElementById(id);
    for (let i = 0; i < row.children.length - 1; i++) {
        row.cells[i].innerHTML = '<input type="text" class="form-control" value="' + row.cells[i].innerText + '">';
    }
    document.querySelectorAll("a.add")[row.rowIndex - 1].style.display = "inline";
    document.querySelectorAll("a.edit")[row.rowIndex - 1].style.display = "none";
    document.getElementById("add-new").disabled = true;
}
// Delete row on delete button click
function del(x) {
    var id = x.parentElement.parentElement.id;
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        var result = (response == null) ? "Delete success" : "Delete fail";
        alert(result);
        show();
    }
    xhr.open("POST", "Employee/del_employee");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id);
}