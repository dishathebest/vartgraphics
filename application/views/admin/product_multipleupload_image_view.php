<div id="uploader">
    <p>Your browser doesn't have Flash, Silverlight or HTML5 support.</p>
</div>
<div id="resultUpload" style="float:left"></div>
<div style="margin-top:20px;float:right;">
<?= form_button(array("type" => "reset", "class" => "btn btn-info", "content" => "Back", "onClick" => "window.location='".$this->config->item('base_url_admin')."products/images'")) ?>
</div>
<script type="text/javascript">
// Initialize the widget when the DOM is ready
    $(function() {
	$("#uploader").plupload({
	    // General settings
	    runtimes: 'html5,flash,silverlight,html4',
	    url: '<?= $this->config->item('base_url_admin') ?>products/save_multipleUpload',
	    // User can upload no more then 20 files in one go (sets multiple_queues to false)
	    max_file_count: 20,
	    chunk_size: '1mb',
	    // Resize images on clientside if we can
	    resize: {
		width: 200,
		height: 200,
		quality: 90,
		crop: true // crop to exact dimensions
	    },
	    filters: {
		// Maximum file size
		max_file_size: '1000mb',
		// Specify what files to browse for
		mime_types: [
		    {title: "Image files", extensions: "jpg,gif,png"},
		    {title: "Zip files", extensions: "zip"}
		]
	    },
	    // Rename files by clicking on their titles
	    rename: true,
	    // Sort files
	    sortable: true,
	    // Enable ability to drag'n'drop files onto the widget (currently only HTML5 supports that)
	    dragdrop: true,
	    // Views to activate
	    views: {
		list: true,
		thumbs: true, // Show thumbs
		active: 'thumbs'
	    },
	    multipart_params: {
		pro_id:<?= $pro_id ?>
	    },
	    init: {
		FileUploaded: function(up, file, info) {
		    var data = $.parseJSON(info.response);
		    $("#resultUpload").html($("#resultUpload").html() + "<p class=" + data.class + "><b>"+data.org_filename+"</b> " + data.status + "</p>");
		}
	    }
	});
    });
</script>