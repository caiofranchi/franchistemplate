<?php
/**
 * Created by PhpStorm.
 * User: cfranchi
 * Date: 31/07/14
 * Time: 17:47
 */
require_once "inc/header.php"

?>
<?php require_once "inc/topo.php"; ?>

    <div class="container-fluid">
        <div class="row">

    <?php require_once "inc/menu.php"; ?>

            <div id="main-content" class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">


                <div class="page-header">
                    <h1 class="">/Users <small>/List</small></h1>
                </div>

                <form class="navbar-form navbar-right page-header" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" required="required">
                    </div>
                    <button type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
                </form>


                <!-- SEARCH -->


                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#id</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>Header</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1,001</td>
                                <td>Lorem</td>
                                <td>ipsum</td>
                                <td>dolor</td>
                                <td>sit</td>
                                <td>

                                    <button type="button" class="btn btn-default btn-xs" title="EDIT">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </button>

                                    <button type="button" class="btn btn-default btn-xs" title="REMOVE">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <ul class="pagination">
                    <li class="disabled"><a href="#">&laquo;</a></li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">»</a></li>
                </ul>
            </div>
             </div>
<?php

require_once "inc/footer.php"

?>