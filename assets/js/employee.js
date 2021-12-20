// Action Buttons
function actions() {
    var actions = 
        '<a class="add" title="Add" onclick="add(this)" data-toggle="tooltip"><i class="material-icons">&#xE03B;</i></a>' +
        '<a class="edit" title="Edit" onclick="edit(this); list_departmentName();" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>' +
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
                '<tr id="' + item['id'] + '">' +
                    '<td>' + item['firstName'] + '</td>' +
                    '<td>' + item['lastName'] + '</td>' +
                    '<td>' + item['telephone'] + '</td>' +
                    '<td>' + item['departmentName'] + '</td>' +
                    '<td>' + actions() + '</td>' +
                '</tr>';
        }
        document.getElementById('list-employees').innerHTML = result;
    }
    xhr.open("GET", "Employee/list_employees");
    xhr.send();
}
function list_departmentName() {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        var result = '<option value="0">...</option>';
        for (let item of response) {
            result += '<option value="' + item['id'] + '">' + item['departmentName'] + '</option>';
        }
        document.getElementById('departmentName').innerHTML = result;
    }
    xhr.open("GET", "Department/list_departments");
    xhr.send();
}
// Append table with add row form on add new button click
function add_new() {
    document.getElementById("add-new").disabled = true;
    var row = 
        '<td><input type="text" class="form-control" ></td>' +
        '<td><input type="text" class="form-control" ></td>' +
        '<td><input type="text" class="form-control" ></td>' +
        '<td><input type="text" class="form-control" value="0" hidden>' +
        // Number 3 is the hidden input right above here ☝️
        '<select class="form-control" id="departmentName" onchange="document.querySelectorAll(\'input[type=text]\')[3].value = this.value"></select></td>' +
        '<td>' + actions() + '</td>';
    var tableRef = document.getElementById("list-employees");
    var newRow = tableRef.insertRow(-1);
    newRow.id = 'add-employee';
    newRow.innerHTML = row;
    document.querySelectorAll("a.add")[tableRef.rows.length - 1].style.display = "inline";
    document.querySelectorAll("a.edit")[tableRef.rows.length - 1].style.display = "none";
}
// Add employee
function add_employee(data) {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        delete response["id"];
        var result = (JSON.stringify(data) == JSON.stringify(response)) ? "Add success" : "Add fail";
        alert(result);
        show();
    }
    xhr.open("POST", "Employee/add_employee");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("firstName=" + data['firstName'] + "&lastName=" + data['lastName'] + "&telephone=" + data['telephone'] + "&departmentId=" + data['departmentId']);
}
// Edit employee
function edit_employee(id, data) {
    const xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var response = JSON.parse(this.responseText);
        response_id = response['id'];
        delete response["id"];
        var result = (id == response_id && JSON.stringify(data) == JSON.stringify(response)) ? "Edit success" : "Edit fail";
        alert(result);
        show();
    }
    xhr.open("POST", "Employee/edit_employee");
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send("id=" + id + "&firstName=" + data['firstName'] + "&lastName=" + data['lastName'] + "&telephone=" + data['telephone'] + "&departmentId=" + data['departmentId']);
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
        var data = {
            "firstName": input[0].value,
            "lastName": input[1].value,
            "telephone": input[2].value,
            "departmentId": input[3].value
        };
        var id = x.parentElement.parentElement.id;
        if (id == "add-employee") {
            add_employee(data);
        } else {
            edit_employee(id, data);
        }
        document.getElementById("add-new").removeAttribute("disabled");
    }
}
// Edit row on edit button click
function edit(x) {
    var id = x.parentElement.parentElement.id;
    var row = document.getElementById(id);
    for (let i = 0; i < row.children.length - 2; i++) {
        row.cells[i].innerHTML = '<input type="text" class="form-control" value="' + row.cells[i].innerText + '">';
    }
    // Number 3 is the hidden input right here 👇
    row.cells[3].innerHTML = '<input hidden type="text" class="form-control" value="0">' +
        '<select class="form-control" id="departmentName" onchange="document.querySelectorAll(\'input[type=text]\')[3].value = this.value"></select>';
    
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
