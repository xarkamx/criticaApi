class Tables extends Tools {
    createTable(path, table, specialEvents = {}) {
        debugger;
        let pn = table.querySelector("tbody");
        let tn = pn.querySelector("tr");
        this.ajax.postData(path, {}, (ev) => {
            this.data = JSON.parse(ev);
            this.fillTable(table, ev, tn, pn, specialEvents);
        });
    }
    fillTable(table, json, tn, pn, specialEvents) {
        this.templates.fillTemplate(pn, tn, json, specialEvents);
        specialEvents.dataTable = $(table).DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {
                    extend: 'copy'
                    },
                {
                    extend: 'csv'
                    },
                {
                    extend: 'excel',
                    title: 'Clientes'
                    },

                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                    }
                ],
            //data:da,
        });
    }
    addTrInTable(path, parent) {
        if (document.querySelector('.details') != null) {
            document.querySelector('.details').remove();
            return false;
        }
        let tr = document.createElement('tr');
        let content = this.ajax.import(path);
        let colspan = parent.childNodes.length;
        tr.innerHTML = '<td colspan=' + colspan + '>' + content + '</td>';
        tr.classList.add('details');
        parent.insertAdjacentElement('afterend', tr);
    }
    delete(table, row) {
        table.row($(row)).remove().draw();
    }

}
