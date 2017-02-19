<div class='row'>
<?php
if (array_key_exists('error', $_SESSION)) {
    ?>
    <div class="alert alert-danger" role="alert"><?php echo $_SESSION['error']?></div>
    <?php
    unset($_SESSION['error']);
}
?>
<?php

if (array_key_exists('success', $_SESSION)) {
    ?>
    <div class="alert alert-success" role="alert"><?php echo $_SESSION['success']?></div>
    <?php
    unset($_SESSION['success']);
}
?>
</div>
<div class="row">
    <?php
    if (array_key_exists("error", $params)) {
        ?>
        <div class='row'>
		<div class='col-xs-12'>
			<h1>No Threads Found</h1>
        <?php
        if (array_key_exists('userid', $_SESSION)) {
            ?>
                        <a href="?r=threads/create"><button>Create new
					Thread</button></a>
                        <?php
        } else {
            ?>
                        <a href='?r=user/auth'><button>Signin or
					Register to create new Thread</button></a>
                        <?php
        }
        ?>
            </div>
	</div>
        <?php
    } else {
        ?>
       <?php
        if (array_key_exists('userid', $_SESSION)) {
            ?>
                        <a href="?r=threads/create"><button>Create new
			Thread</button></a>
                        <?php
        } else {
            ?>
                        <a href='?r=user/auth'><button>Signin or
			Register to create new Thread</button></a>
                        <?php
        }
        ?>
        <?php
    }
    ?>

</div>
<!-- /.row -->