<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<script type="text/javascript">
    function addRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if (rowCount < 5) {                            // limit the user from creating fields more than your limits
            var row = table.insertRow(rowCount);
            var colCount = table.rows[0].cells.length;
            for (var i = 0; i < colCount; i++) {
                var newcell = row.insertCell(i);
                newcell.innerHTML = table.rows[0].cells[i].innerHTML;
            }
        } else {
            alert("Maximum Passenger per ticket is 5");

        }
    }

    function deleteRow(tableID) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        for (var i = 0; i < rowCount; i++) {
            var row = table.rows[i];
            var chkbox = row.cells[0].childNodes[0];
            if (null != chkbox && true == chkbox.checked) {
                if (rowCount <= 1) {               // limit the user from removing all the fields
                    alert("Cannot Remove all the Passenger.");
                    break;
                }
                table.deleteRow(i);
                rowCount--;
                i--;
            }
        }
    }
</script>

<html>
    <body>
        <p> 
            <input type="button" value="Add Passenger" onClick="addRow('dataTable')" /> 
            <input type="button" value="Remove Passenger" onClick="deleteRow('dataTable')" /> 
        <p>(All acions apply only to entries with check marked check boxes only.)</p>
    </p>

    <table id="dataTable" class="form" border="1">
        <tbody>
            <tr>
        <p>
        <td >
            <input type="checkbox" name="chk[]" checked="checked" />
        </td>
        <td>
            <label>Name</label>
            <input type="text" name="BX_NAME[]">
        </td>
        <td>
            <label for="BX_age">Age</label>
            <input type="text" class="small"  name="BX_age[]">
        </td>
        <td>
            <label for="BX_gender">Gender</label>
            <select id="BX_gender" name="BX_gender">
                <option>....</option>
                <option>Male</option>
                <option>Female</option>
            </select>
        </td>
        <td>
            <label for="BX_birth">Berth Pre</label>
            <select id="BX_birth" name="BX_birth">
                <option>....</option>
                <option>Window</option>
                <option>No Choice</option>
            </select>
        </td>
    </p>
</tr>
</tbody>
</table>
</body>
</html>