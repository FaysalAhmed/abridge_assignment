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
<form method="get" action="?r=threads/threadlist">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <input type="submit" class="btn btn-default" type="button">Search</input>
                    </span>
                </div>
            </form>
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
                    <a href="?r=threads/create"><button>Create new Thread</button></a>
                    <?php
                } else {
                    ?>
                    <a href='?r=user/auth'><button>Signin or Register to create
                            new Thread</button></a>
                    <?php
                }
                ?>

            </div>

        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <?php
            if (array_key_exists('userid', $_SESSION)) {
                ?>
                <a href="?r=threads/create"><button>Create new Thread</button></a>
                <?php
            } else {
                ?>
                <a href='?r=user/auth'><button>Sign in or Register to create new Thread</button></a>
                <?php
            }
            ?>
            <br/><br/>
            
            <?php foreach ($params['threads'] as $thread) { ?>
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class='row'>
                                <div class='col-xs-10'>
                                    <a href="?r=threads/details&thread_id=<?php echo $thread['id'] ?>"><h1><?php echo $thread['name'] ?></h1></a>
                                </div>
                                <div class="col-xs-2">
                                    <?php if (array_key_exists('userid', $_SESSION) && $thread['creator'] == $_SESSION['userid']) {
                                        ?>
                                        <a href="?r=threads/update&thread_id=<?php echo $thread['id'] ?>"><button>Edit</button></a>
                                        <a href="?r=threads/delete&thread_id=<?php echo $thread['id'] ?>"><button>Delete</button></a>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12'>
                                    <?php echo $thread['text'] ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-xs-12'>
                                    Created by  <?php echo $thread['username'] ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-xs-4'>
                                    Created at <?php echo $thread['created_at'] ?>
                                </div>
                                <div class='col-xs-4'>
                                    Updated at <?php echo $thread['updated_at'] ?>
                                </div>
                                <div class='col-xs-4'>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php
        }
        ?>

    </div>
    <!-- /.row -->