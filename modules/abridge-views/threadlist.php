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
                    <button>Create new Thread</button>
                    <?php
                } else {
                    ?>
                    <a href='?r=user/auth'><button>Signin or Register to create new Thread</button></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    } else {
        ?>
        TODO: Show threads
        <?php
    }
    ?>

</div>
<!-- /.row -->