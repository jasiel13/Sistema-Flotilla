function tableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // nombre de archivo
    filename = filename?filename+'.xls':'excel_data.xls';
    
    // referencia agregada
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // link de archivo
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        //el nombre archivo a link
        downloadLink.download = filename;
        
        //ejecutando la descarga
        downloadLink.click();
    }
}