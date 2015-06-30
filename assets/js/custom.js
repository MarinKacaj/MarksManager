/**
 * Created by Ina Qirko on 6/13/2015.
 */

/**
 * Initializes data table with translated labels.
 *
 * @param {String} tableID
 */
function initDataTable(tableID) {
    $(document).ready(function () {
        $('#' + tableID).DataTable({
            responsive: true,
            language: {
                processing: "Duke p&euml;rpunuar",
                search: "K&euml;rko:",
                lengthMenu: "Shfaqni _MENU_ element&euml;",
                info: "Shfaqja e element&euml;ve _START_ n&euml; _END_ nga _TOTAL_ element&euml;",
                infoEmpty: "Shfaqja e elementit 0 &euml;sht&euml; 0 nga 0 element&euml;",
                infoFiltered: "(T&euml; filtruar; nga _MAX_ element&euml; gjithsej)",
                infoPostFix: "",
                loadingRecords: "Ndryshimi po kryhet",
                zeroRecords: "Nuk u gjend asnj&euml; element",
                emptyTable: "Nuk ka t&euml; dh&euml;na t&euml; disponueshme",
                paginate: {
                    first: "Fillim",
                    previous: "Mbrapa",
                    next: "P&euml;rpara",
                    last: "Fund"
                },
                aria: {
                    sortAscending: ": aktivizoni p&euml;r t&euml; rradhitur kolon&euml;n n&euml; rend rrit&euml;s",
                    sortDescending: ": aktivizoni p&euml;r t&euml; rradhitur kolon&euml;n n&euml; rend zbrit&euml;s"
                }
            }
        });
    });
}