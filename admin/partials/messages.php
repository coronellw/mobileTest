<div id="alerts">
    <?php
    if (isset($_SESSION['messages'])) {
        for ($i = 0; $i < count($_SESSION['messages']); $i++) {
            $message = $_SESSION['messages'][$i];
            ?>
            <div class="alert alert-dismissible alert-<?php echo $message['type'] ?>">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">
                        &times;
                    </span>
                    <span class="sr-only">
                        Close
                    </span>
                </button>
                <strong>
                    <?php echo $message['title']; ?>
                </strong>
                <span class="alert-content">
                    <?php echo $message['message']; ?>
                </span>
            </div>
            <?php
        }
        unset($_SESSION['messages']);
    }
    ?>
</div>