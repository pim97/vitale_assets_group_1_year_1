$(document).ready(function () {

    //language settings
    var dutch = {
        "aria": {
            "sortAscending": ": activeer kolom sorteren oplopend",
                "sortDescending": ": activeer kolom sorteren afdelend"
        },
        "decimal": "",
            "infoPostFix": "",
            "paginate": {
            "first": " Eerste",
                "last": " Laatste ",
                "next": " Volgende ",
                "previous": " Vorige "
        },
        "thousands": ",",
            "search": "Zoeken:",
            "processing": "Zoeken naar resultaten...",
            "loadingRecords": "Laden van resultaten..",
            "emptyTable": "Geen resultaat",
            "zeroRecords": "Geen zoekresultaten",
            "lengthMenu": "Selecteer _MENU_ resultaten",
            "info": "Pagina _PAGE_ van _PAGES_",
            "infoEmpty": "Geen items gevonden",
            "infoFiltered": "(gefiltered _MAX_ totale resultaten)"
    };

    //breaches/index.blade.php
    $('#breachlocations-table').DataTable({
        language: dutch,
        "columnDefs": [
            { "orderable": false, "targets": 8 }
        ],
        "pageLength": 100
    });

    //loadlevels/index.blade.php
    $('#loadlevels-table').DataTable({
        language: dutch,
        "columnDefs": [
            { "orderable": false, "targets": 4 }
        ],
        "pageLength": 100
    });

    // //assets/show.blade.php
    // $('table.asset-breachlocation-waterdepth-table').DataTable({
    //     language: dutch,
    //     // "columnDefs": [
    //     //     { "orderable": false, "targets": 2 }
    //     // ],
    //     "order": [[ 1, "desc" ]],
    //     "pageLength": 10
    // });

    //scenarios/index.blade.php
    $('#scenario-table').DataTable({

        aoColumnDefs: [
            { "bSortable": false, "aTargets": [3] },
            { "bSearchable": false, "aTargets": [3] }],
        processing: true,
        serverSide: true,

        ajax: '/scenarios/getDataTable',
        columns: [
            { data: "id",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='/scenarios/"+oData.id+"'>"+oData.id+"</a>");
                },

            },
            { data: "name",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a href='/scenarios/"+oData.id+"'>"+oData.name+"</a>");
                }
            },
            {data: 'description'},
            {defaultContent: "",
                "fnCreatedCell": function (nTd, sData, oData, iRow, iCol) {
                    $(nTd).html("<a style='width: 82px;' class='btn btn-warning btn-sm' href='/scenarios/"+oData.id+"/edit'>Wijzigen</a> <a style='width: 82px;' class='btn btn-danger btn-sm' href='/scenarios/delete/"+oData.id+"'>Verwijderen</a>");
                },
            },

        ],
        rowId: 'id',
        language: dutch,
        "pageLength": 100
    });

    //breaches/index.blade.php
    $('#category-assets-table').DataTable({
        language: dutch,
        // "columnDefs": [
        //     { "orderable": false, "targets": 8 }
        // ],
        "pageLength": 10
    });

    //others...
});