<script type="text/javascript">

    //DOM ready
    window.addEventListener('load', init);

    //define searchfield by id
    const searchForm = document.getElementById('searchField');

    function init() {
        //listen to search field when a key goes up and trigger function
        searchForm.addEventListener('keyup', searchSubmitHandler);
    }

    //function calls the ajax object
    const searchSubmitHandler = () => {

        $.ajax({
            url: '/categories/search',
            type: 'get',
            data: {
                search: searchForm.value, //search value
                _token: $('meta[name="csrf-token"]').attr('content'), //cstf token
            },
            success: successCallbackHandler, //success function
            error: function (e) {
                console.log(e);
            }
        });

    };

    /**
     *
     * @param results json with results
     */
    const successCallbackHandler = (results) => {

        //table results
        let tbody = document.getElementById('results');
        tbody.innerHTML = '';

        //loop trough all results and put it into a table
        for (let i = 0; i < results.data.length; i++) {

            let tr = document.createElement('tr');

            tr.innerHTML = `
                            <td>${results.data[i].id}</td>
                            <td><a href="/categories/${results.data[i].id}">${results.data[i].name}</a></td>
                            <td>${(results.data[i].description ? results.data[i].description : '(geen beschrijving)')}</td>
                            <td>
                            <a href="/categories/${results.data[i].id}/edit" type="button" class="btn btn-warning btn-sm">Wijzigen</a>
                            <a href="/categories/delete/${results.data[i].id}" type="button" class="btn btn-danger btn-sm">Verwijderen</a>
                            </td>`;

            tbody.appendChild(tr);
        }

        //update pagination info
        let paginationFirstItem = document.getElementById('first_item').innerHTML = results.from;
        let paginationLastItem = document.getElementById('last_item').innerHTML = results.to;
        let paginationTotal = document.getElementById('total').innerHTML = results.total;

    };

</script>