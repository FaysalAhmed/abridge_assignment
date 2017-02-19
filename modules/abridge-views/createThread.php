<script src="modules/ckeditor/ckeditor.js"></script>
<div class='row'>
	<div class='col-xs-12'>
		<a href="?r=threads/threadlist">Back to List</a>
	</div>
</div>

<form method='post' action='?r=threads/save'>
	<div class='row'>
		<div class='col-xs-12'>
			<input class='form-control' type='text' name='thread_name'
				placeholder="Title" />
		</div>
	</div>
	<div class='row'>
		<div class='col-xs-12'>
			<textarea name="thread_text" id="editor1" rows="10" cols="80">
        </textarea>

		</div>
	</div>
	<div class='row'>

		<div class='col-xs-12'>
			<br /> <input type='submit' value='submit' />
		</div>
	</div>

</form>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
        CKEDITOR.replace( 'editor1' );
</script>