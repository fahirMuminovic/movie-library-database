function search() {

    let input, filter, table, tr, td, i;
    input = document.getElementById("search-input");
    filter = input.value.toUpperCase();
    table = document.getElementById("table2");
    tr = table.getElementsByClassName("tr");
    th = table.getElementsByTagName("th");

    // prva for petlja za pretragu po redovima tabele, takođe služi za skrivanje redova koji ne ispunjavaju uslov pretrage
    for (i = 0; i < tr.length; i++) {

        tr[i].style.display = "none";
        //druga for petlja da bi se moglo tražiti u svakoj koloni tabele
        for (var j = 0; j < th.length; j++) {
            //onemogućeno pretraživanje imdb i youtube linkova
            if (j == 5 || j == 6) {
                continue;
            }

            td = tr[i].getElementsByTagName("td")[j];

            if (td) {
                if (td.innerHTML.toUpperCase().indexOf(filter.toUpperCase()) > -1) {
                    tr[i].style.display = "";
                    break;
                }
            }
        }
    }
}


// posuđeni dio koda za sortiranje tabele po kolonama u zavisnosi na koju kolonu se klikne 
// prvi klik sortira ASC drugi klik sortira DESC

document.addEventListener('DOMContentLoaded', function () {
    const table = document.getElementById('table2');
    const headers = table.querySelectorAll('th');
    const tableBody = table.querySelector('tbody');
    const rows = tableBody.querySelectorAll('tr');

    // Track sort directions
    const directions = Array.from(headers).map(function (header) {
        return '';
    });

    // Transform the content of given cell in given column
    const transform = function (index, content) {
        // Get the data type of column
        const type = headers[index].getAttribute('data-type');
        switch (type) {
            case 'number':
                return parseFloat(content);
            case 'string':
            default:
                return content;
        }
    };

    const sortColumn = function (index) {
        // Get the current direction
        const direction = directions[index] || 'asc';

        // A factor based on the direction
        const multiplier = direction === 'asc' ? 1 : -1;

        const newRows = Array.from(rows);

        newRows.sort(function (rowA, rowB) {
            const cellA = rowA.querySelectorAll('td')[index].innerHTML.trim();
            const cellB = rowB.querySelectorAll('td')[index].innerHTML.trim();

            const a = transform(index, cellA);
            const b = transform(index, cellB);

            switch (true) {
                case a > b:
                    return 1 * multiplier;
                case a < b:
                    return -1 * multiplier;
                case a === b:
                    return 0;
            }
        });

        // Remove old rows
        [].forEach.call(rows, function (row) {
            tableBody.removeChild(row);
        });

        // Reverse the direction
        directions[index] = direction === 'asc' ? 'desc' : 'asc';

        // Append new row
        newRows.forEach(function (newRow) {
            tableBody.appendChild(newRow);
        });
    };

    [].forEach.call(headers, function (header, index) {
        header.addEventListener('click', function () {
            sortColumn(index);
        });
    });
});



