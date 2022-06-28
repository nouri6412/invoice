//trigger download of data.xlsx file



var XL_row_object = [];
document.getElementById('uploadFileRelation').addEventListener('change', handleFileSelect, false);
var ExcelToJSON = function () {

    this.parseExcel = function (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            var flag = false;
            $('#alert-excel').html('');
            $('#alert-excel').css('display', 'none');
            $('#success-excel').html('');
            $('#success-excel').css('display', 'none');

            workbook.SheetNames.forEach(function (sheetName) {
                XL_row_object = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheetName]);
                //  var json_object = JSON.stringify(XL_row_object);
                Data_Excel = XL_row_object;
                console.log(XL_row_object);
                if (XL_row_object.some(x => x['RADIF']) && XL_row_object.some(x => x['TABAGHE']) && XL_row_object.some(x => x['SOTOON']) && XL_row_object.some(x => x['ETESALI']) && XL_row_object.some(x => x['EQUIP_NUMBER'])) {
                    flag = true;
                    //  mid_send(1);
                }
            })
            if (!flag) {
                $('#alert-excel').css('display', 'block');
                $('#alert-excel').html('فیلد های فایل اکسل مطابق فایل نمونه نمی باشد');
            }

        };

        reader.onerror = function (ex) {
            console.log(ex);
        };

        reader.readAsBinaryString(file);
    };
};

function GetSwitchBukhtFile(field_switch = 1) {
    var str = "{card_id:'" + @Model.CardId+"'}";
    $.ajax({
        type: "POST",
        url: '@Url.Action("GetSwitchBukht")',
        data: str,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (msg) {
            $('#get_switch_bukht_file').html('');
            console.log(msg);
            var jss = msg;
            var i = 0;
            if (jss.length > 0) {

                var columns = [];
                columns[columns.length] = { title: "RADIF", field: "RADIF", width: 100, sorter: "number" };
                columns[columns.length] = { title: "TABAGHE", field: "TABAGHE", width: 100, sorter: "number" };
                columns[columns.length] = { title: "SOTOON", field: "SOTOON", width: 100, sorter: "number" };
                columns[columns.length] = { title: "ETESALI", field: "ETESALI", width: 100, sorter: "number" };
                if (field_switch == 1) {
                    columns[columns.length] = { title: "SWITCH", field: "SWITCH" };
                }
                columns[columns.length] = { title: "EQUIP_NUMBER", field: "EQUIP_NUMBER" };
                var my_table_bukht = new Tabulator("#get_switch_bukht_file", {
                    height: "311px",
                    data: jss,
                    columns: columns,
                });

                //trigger download of data.xlsx file
                document.getElementById("download-xlsx").addEventListener("click", function () {
                    my_table_bukht.download("xlsx", "data.xlsx", { sheetName: "My Data" });
                });

                //trigger download of data.pdf file
                document.getElementById("download-pdf").addEventListener("click", function () {
                    my_table_bukht.download("pdf", "data.pdf", {
                        orientation: "portrait", //set page orientation to portrait
                        title: "Example Report", //add title to report
                    });
                });

            }

        },
        error: function (error) {
            //Message
            console.error(error.responseText);
        }
    });
}
GetSwitchBukhtFile();

function handleFileSelect(evt) {

    var files = evt.target.files; // FileList object
    var xl2json = new ExcelToJSON();
    xl2json.parseExcel(files[0]);
    console.log(xl2json.output);
}
function mid_send(is_check) {
    if (XL_row_object.length == 0) {
        $('#alert-excel').css('display', 'block');
        $('#alert-excel').html('هیچ اطلاعاتی برای ثبت آماده نیست لطفا فایل را آپلود نمائید.');
        return;
    }

    console.log($('#BukhtSwitchId').val());

    var switch_id = 0;
    switch_id = $('#BukhtSwitchId').val();

    if (switch_id === 0 || switch_id === null) {
        $('#alert-excel').css('display', 'block');
        $('#alert-excel').html('لطفا سوئیچ را انتخاب نمائید');
        return;
    }
    var CurrentDB = [];
    var i = 0;
    var j = 0;
    for (i = 0; i < XL_row_object.length; i++) {
        CurrentDB[j] = XL_row_object[i];
        j++;
    }
    console.log(CurrentDB);
    var json_object = JSON.stringify(CurrentDB);
    var str = "{json:'" + json_object + "',switch_id:'" + $('#BukhtSwitchId').val() + "',card_id:'" + @Model.CardId+"',is_check:'" + is_check + "'}";
    sendData(str);
}

function sendData(str, is_check) {
    $.ajax({
        type: "POST",
        url: '@Url.Action("InsertSwitchBukht")',
        data: str,
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        success: function (msg) {
            $('#result_file').html('');
            console.log(msg);
            var jss = msg;
            var i = 0;
            if (jss.length > 0) {
                var tr = '';
                tr += '<tr>';
                tr += '<th>RADIF</th>';
                tr += '<th>TABAGHE</th>';
                tr += '<th>SOTOON</th>';
                tr += '<th>ETESALI</th>';
                tr += '<th>EQUIP_NUMBER</th>';
                tr += '<th>ERROR</th>';
                tr += '</tr>';
                $('#result_file').append(tr);
                for (i = 0; i < jss.length; i++) {
                    tr = '<tr>';
                    tr += '<td>' + jss[i]['RADIF'] + '</td>';
                    tr += '<td>' + jss[i]['TABAGHE'] + '</td>';
                    tr += '<td>' + jss[i]['SOTOON'] + '</td>';
                    tr += '<td>' + jss[i]['ETESALI'] + '</td>';
                    tr += '<td>' + jss[i]['EQUIP_NUMBER'] + '</td>';
                    tr += '<td>' + jss[i]['ERRORCODE'] + '</td>';
                    tr += '</tr>';
                    $('#result_file').append(tr);
                }
            }
            else {
                if (is_check == 1) {
                    $('#success-excel').html('بدون مغایرت و آماده ثبت می باشد');
                    $('#success-excel').css('display', 'block');
                }
                else {
                    $('#success-excel').html('با موفقیت ثبت شد');
                    $('#success-excel').css('display', 'block');
                    GetSwitchBukhtFile();
                }

            }

        },
        error: function (error) {
            //Message
            console.error(error.responseText);
        }
    });
}