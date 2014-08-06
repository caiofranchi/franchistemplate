<?php
/**
 * Created by PhpStorm.
 * User: Caio
 * Date: 03/08/14
 * Time: 19:03
 */

?>

<?php if((string)$flash['error']!==''): ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>ERROR! </strong><?php echo $flash['error']; ?>
    </div>
<?php endif ?>

<?php if((string)$flash['success']!==''): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>SUCCESS!  </strong><?php echo $flash['success']; ?>
    </div>
<?php endif ?>

<?php if((string)$flash['warning']!==''): ?>
    <div class="alert alert-warning alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>WARNING! </strong><?php echo $flash['warning']; ?>
    </div>
<?php endif ?>