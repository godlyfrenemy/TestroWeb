$(document).ready(function() { 
	$('.question-image').on('change', function(){
    var questionId = $(this).attr('id').replace("question-image-", "");
		var preview = $("#question-image-preview-" + questionId);
		updateImageDisplay($(this), preview, $(this).prop('files'), questionId);
	});
});

function updateImageDisplay(currentInput, currentPreview, files, questionId) {
  currentPreview.empty();

  var $paragraph = $("<p>", {"class": "item u-valign-middle"});
  var $img = null;

  if (files.length === 0)
      $paragraph.append('Жодного файлу не обрано');
  else if (validFileType(files[0])) 
  {
      if(isFileSizeOk(files[0].size))
      {
        $paragraph.append(`Файл ${files[0].name}, розмір файлу ${getFileSizeString(files[0].size)}.`);
        writeFile(files[0], questionId);
        var blob = URL.createObjectURL(files[0]);
        $img = $("<img>", {"src": blob, "class": "item"});
      }
      else
        $paragraph.append('Файл ${files[0].name}, розмір файлу ${getFileSizeString(files[0].size)}: ' +
                          'Розмір файлу занадто великий (>5MB), спробуйте знову');
  } 
  else
      $paragraph.append(`Файл ${files[0].name}: Тип файлу не підходить, оберіть знову`);

  currentPreview.append($paragraph);
  currentPreview.append($img);
}

function validFileType(file) {
  const fileTypes = [
    "image/apng",
    "image/bmp",
    "image/gif",
    "image/jpeg",
    "image/pjpeg",
    "image/png",
    "image/svg+xml",
    "image/tiff",
    "image/webp",
    "image/x-icon"
  ];
  return fileTypes.includes(file.type);
}

function isFileSizeOk(number){
    return number < 524288;
}

function getFileSizeString(number) {
  if (number < 1024) { return `${number} bytes`; } 
  else if (number >= 1024 && number < 1048576) { return `${(number / 1024).toFixed(1)} KB`; } 
  else if (number >= 1048576) {return `${(number / 1048576).toFixed(1)} MB`; }
}

function writeFile(file, questionId){
  var formData = new FormData();
  formData.append("uploadFile", file);
  formData.append("questionId", questionId);
  $.ajax({   
    type: 'POST',
    url: "utils/load-file.php", 
    processData: false, // important
    contentType: false, // important
    dataType : 'json',
    data: formData
  });
}