$(document).ready(function(){
    $('body').on("click", "#find-pupil-results-submit", function(e){
        e.preventDefault();
        var data = {
            'test-id' : $('#test-id').val(),
            'pupil-to-find': $('#pupil-to-find').val()
        };
        showTestResults(data);
    });
    $('body').on("click", "#refresh-pupil-results-submit", function(e){
        e.preventDefault();
        var data = {
            'test-id' : $('#test-id').val(),
            'pupil-to-find': ""
        };
        showTestResults(data);
        $('#pupil-to-find').val("");
    });
    $('body').on("click", "#download-test-results", function(e){
        e.preventDefault();
        var data = {
            'test-id' : $('#test-id').val(),
        };
        dowloadTestResults(data);
    });
});

function isEmpty(value) {
    return typeof value == 'string' && !value.trim() || typeof value == 'undefined' || value === null;
}

function showTestResults(_data) {
    var resultHTML = "Error!";
    $.ajax({
        type: "POST",
        url: 'utils/load-test-results.php',
        data: _data,
        success: function(data) {
            resultHTML = data;

            if(isEmpty(resultHTML))
                resultHTML = "<h3 class='first-item'>Жодного результату не зайдено</h3>";

            $('#test-results-list').html(resultHTML).show();
        }
    }).done(function(){
        $('#test-results-list').html(resultHTML).show();
    });
}

function dowloadTestResults(_data) {
    var resultHTML = "Error!";
    $.ajax({
        type: "POST",
        url: 'utils/save-test-results-file.php',
        data: _data,
        success: function(data) {
            var _data = JSON.parse(data);

            if(_data.data)
                convertCSVToXlsx(csvJSON(_data['data']));

        },
        error: function(data){
            console.log(data);
        }
    })
}

function convertCSVToXlsx(data){
    let ws = XLSX.utils.json_to_sheet(data);
    let wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, "Результати");

    var sizes = [];

    for(const key in data[0])
        sizes.push({ wch: getMaxColumnWidth(data, key) });

    ws["!cols"] = sizes;
    XLSX.writeFile(wb, "Результати тестування.xlsx");
}

function csvJSON(csv){
  var lines = csv.split("\n");
  var result = [];
  var headers = lines[0].split(",");

  for(var i = 1; i < lines.length; i++){
      var obj = {};
      var currentline = lines[i].split(",");

      for(var j = 0; j < headers.length; j++)
          obj[headers[j]] = currentline[j];

      result.push(obj);
  }

  return result;
}

function getMaxColumnWidth(data, key)
{
    var max_size = 0;

    for (var i = 0; i < data.length; i++)
        if(data[i][key])
            max_size = Math.max(max_size, data[i][key].length);

    return max_size;
}