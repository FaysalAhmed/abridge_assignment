<?php
$thread = null;
if (array_key_exists('thread', $params)) {
    $thread = $params['thread'];
}
?>
<script src="modules/ckeditor/ckeditor.js"></script>
<div class='row'>
    <div class='col-xs-12'>
        <a href="?r=threads/threadlist">Back to List</a>
    </div>
</div>



<div class='row'>
    <div class='col-xs-10'>
        <h1>
            <?php if ($thread != null) echo $thread['name'] ?>
        </h1>
    </div>
    <div class='col-xs-2'>
        <?php if (array_key_exists('userid', $_SESSION) && $thread['creator'] == $_SESSION['userid']) {
            ?>
            <a href="?r=threads/update&thread_id=<?php echo $thread['id'] ?>"><button>Edit</button></a>
        <?php }
        ?>
    </div>
</div>
<div class='row'>
    <div class='col-xs-12'>
        <?php if ($thread != null) echo $thread['text'] ?>
    </div>
</div>
<div class='row'>

    <div class='col-xs-12'>
        <h3>Comments</h3>
        <div>

        </div>
        <form method='post' action='?r=threads/addcomment&thread_id=<?php echo $thread['id'] ?>'>
            <input type='hidden' name='id' value='<?php echo ($thread == null) ? 0 : $thread['id'] ?>'/>
            <div class='row'>
                <div class='col-xs-12'>
                    You:<textarea class='form-control' id="editor1" name='comment'></textarea>
                </div>
            </div>
            <div class='row'>
                <div class='col-xs-12'>
                    <input type='submit' value="Comment"/>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
//    CKEDITOR.replace('editor1');
</script>

