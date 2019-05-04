jQuery(document).ready(function($) {
    $(document).on('click' , '.upload-button', function(e) {        
		e.preventDefault();
        var $this = $(this);
		var image = wp.media({ 
			title: 'Upload Image',
			// mutiple: true if you want to upload multiple files at once
			multiple: false
		}).open()
		.on('select', function(e){
			// This will return the selected image from the Media Uploader, the result is an object
			var uploaded_image = image.state().get('selection').first();
			// We convert uploaded_image to a JSON object to make accessing it easier
			// Output to the console uploaded_image
			var image_url = uploaded_image.toJSON().url;
			// Let's assign the url value to the input field
			$this.prev('.upload').val(image_url);
            
            var img = "<img src='"+image_url+"' width='271px' height='141px' /><a class='remove-image remove-screenshot'>Remove</a>";
            $this.next('.screenshot').html(img);
		});
	});
    $(document).on('click' , '.remove-image', function(e) {
        $(this).parent().prev().prev('.upload').val('');
        $(this).parent().html('');    
});
});