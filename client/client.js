

// To get the length of table row entered
function len() {
	var len_tr = $("#productTable tr").length - 1;
	document.getElementById("len").value = len_tr;}


  // Current product being edited
	var _row = null;

  function productUpdate() {
	  //check if input fields are empty
  if ($("#sessdate").val() != ''&&
      $("#pay").val() != 'NaN') {
    // Add product to Table
  if ($("#updateButton").text() == "Update") {
    productUpdateInTable();
  }
  else {
    productAddToTable();
  }
    // Clear form fields
    formClear();
    // Focus to product name field
    $("#introdate").focus();
	//to update the enteries field
	len();
  }
  else { alert ("Incomplete/Inaccurate data fields!!!")}

}

function formClear() {
	//set all inputs to empty
  $("#pay").val("");
  $("#venue").val("");
}

//retreive values from input fields that are being edited
function productUpdateInTable() {
  // Add changed product to table
  $(_row).after(productBuildTableRow());
  // Remove old product row
  $(_row).remove();
  // Clear form fields
  formClear();
  // Change Update Button Text
  $("#updateButton").text("Add");
  //to update the enteries field
  len();
}


//Retrieve values from input fields and build a row for a table

function productAddToTable() {
  // First check if a <tbody> tag exists, add one if not
  if ($("#productTable tbody").length == 0) {
    $("#productTable").append("<tbody></tbody>");
  }

  // Append product to the table
  $("#productTable tbody").append(
      "<tr>" +
		"<td>" + "<button type='button' " + "onclick='productDisplay(this);' " + "id = 'editbutton' " + "class='btn btn-default'>" + "<span class='far fa-edit' />" + "</button>" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 90px;' " + "name = 'sessdates[]' " + "id = 'sessdates' " + "value = '" + $("#sessdate").val() + "' readonly />" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 70px;' " + "name = 'invignames[]' " + "id = 'invignames' " + "value = '" + $("#invigname").val() + "' readonly />" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 50px;' " + "name = 'pays[]' " + "id = 'pays' " + "value = '" + $("#pay").val() + "' readonly />" + "</td>" +
    "<td>" +"<button type='button' " +"onclick='productDelete(this);' " + "class='btn btn-default'>" +"<span class='fas fa-trash-alt' />" +"</button>" + "</td>" +
      "</tr>"
      );

}

function productDelete(ctl) {
  $(ctl).parents("tr").remove();
  len();
}

function productDisplay(ctl) {
  _row = $(ctl).parents("tr");
  var cols = _row.children("td");
  var sdate = document.getElementById("sessdates").value;
  var invname = document.getElementById("invignames").value;
	var pay_task = document.getElementById("pays").value;
  $("#sessdate").val(sdate);
  $("#invigname").val(invname);
  $("#pay").val(pay_task);
  // Change Update Button Text
  $("#updateButton").text("Update");
  $("#editbutton").style.background("red");
}


//Build an Edit button in JavaScript

function productBuildTableRow() {
  var ret =
  "<tr>" +
		"<td>" + "<button type='button' " + "onclick='productDisplay(this);' " + "id = 'editbutton' " + "class='btn btn-default'>" + "<span class='far fa-edit' />" + "</button>" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 90px;' " + "name = 'sessdates[]' " + "id = 'sessdates' " + "value = '" + $("#sessdate").val() + "' />" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 70px;' " + "name = 'invignames[]' " + "id = 'invignames' " + "value = '" + $("#invigname").val() + "' />" + "</td>" +
        "<td>" + "<input type = 'text' " + "style = 'width: 50px;' " + "name = 'pays[]' " + "id = 'pays' " + "value = '" + $("#pay").val() + "' />" + "</td>" +
    "<td>" +"<button type='button' " +"onclick='productDelete(this);' " + "class='btn btn-default'>" +"<span class='fas fa-trash-alt' />" +"</button>" + "</td>" +
      "</tr>"

  return ret;
}
//$(document).ready(function(){
/*$('#submit').click(function(){

		$.ajax({
			url:"inv_task.php",
			method:"POST",
			data:$('#add_name'),
			success:function(data){
				alert(data);
				$('#add_name')[0].reset();
			}
		});
	});*/
//});
