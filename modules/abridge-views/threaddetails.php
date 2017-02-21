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
    <?php
    if (array_key_exists('error', $_SESSION)) {
        ?>
        <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error'] ?></div>
        <?php
        unset($_SESSION['error']);
    }
    ?>
    <?php
    if (array_key_exists('success', $_SESSION)) {
        ?>
        <div class="alert alert-success" role="alert"><?php echo $_SESSION['success'] ?></div>
        <?php
        unset($_SESSION['success']);
    }
    ?>
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
            <?php
            if (array_key_exists("comments", $params)) {
                foreach ($params["comments"] as $comment) {
                    ?>
                    <div class="row">
                        <div class="col-xs-12">
                            <h4><?php
                                if (array_key_exists("userid", $_SESSION) && $comment['commented_by'] == $_SESSION['userid']) {
                                    echo "You";
                                } else {
                                    echo $comment['username'];
                                }
                                ?>:</h4><br/> <?php echo $comment["text"]; ?>
                            <?php
                            if (array_key_exists("userid", $_SESSION) && $comment['commented_by'] == $_SESSION['userid']) {
                                ?>
                                <a href="?r=comments/deletecomment&id=<?php echo $comment['comment_id'] ?>&thread_id=<?php echo $thread['id'] ?>">Delete</a>
                                <?php
                            } else {
                                
                            }
                            ?>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
        <?php
        if (array_key_exists('userid', $_SESSION)) {
            ?>
            <form method='post' action='?r=comments/addcomment&thread_id=<?php echo $thread['id'] ?>'>
                <input type='hidden' name='id' value='<?php echo ($thread == null) ? 0 : $thread['id'] ?>'/>
                <div class='row'>
                    <div class='col-xs-12'>
                        <h4>You:</h4><textarea class='form-control' id="editor1" name='comment'></textarea>
                    </div>
                </div>
                <div class='row'>
                    <div class='col-xs-12'>
                        <input type='submit' value="Comment"/>
                    </div>
                </div>
            </form>
            <?php
        } else {
            ?>
            <a href='?r=user/auth'><button>Sign in or Register to create new Thread</button></a>
            <?php
        }
        ?>

    </div>
</div>
<script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
//    CKEDITOR.replace('editor1');
</script>

