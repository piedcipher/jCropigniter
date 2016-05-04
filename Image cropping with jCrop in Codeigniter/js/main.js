$(document).ready(function() {
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
 
            reader.onload = function(e) {
                $('.jcrop-holder').replaceWith('');
                $('#dp_preview').replaceWith('<img class="crop" id="dp_preview" src="' + e.target.result + '" />');
 
                $('.crop').Jcrop({
                    onSelect: updateCoords,
                    onChange: updateCoords,
                    bgOpacity: '.5',
                    bgColor: 'black',
                    addClass: 'jcrop-dark',
                    maxSize: [900, 900]
                });
            }
 
            reader.readAsDataURL(input.files[0]);
        }
    }
 
    $('#image').change(function() {
        readURL(this);
    });
 
    function updateCoords(c) {
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#x2').val(c.x2);
        $('#y2').val(c.y2);
        $('#w').val(c.w);
        $('#h').val(c.h);
        // console.log(c);
    };
});