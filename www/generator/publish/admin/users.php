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
                    <h1 class="">/ENTITY NAME <small>/CURRENT ACTION</small></h1>
                </div>



                <form class="form-horizontal" role="form">
                    <input type="hidden" name="_METHOD" value="PUT"/>
                    <input type="hidden" name="id" value=""/>

                    <div class="form-group">
                        <label for="firstname" class="col-sm-2 control-label">TEXT/EMAIL/PASSWORD FIELD</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="firstname"
                                   placeholder="Enter First Name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Text Area</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Default Checkbox</label>
                        <div class="col-sm-8">
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Option 1</label>
                            </div>
                            <div class="checkbox">
                                <label><input type="checkbox" value="">Option 2</label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Default Radio</label>
                        <div class="col-sm-8">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios1"
                                           value="option1" checked> Option 1
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <input type="radio" name="optionsRadios" id="optionsRadios2"
                                           value="option2">
                                    Option 2 - selecting it will deselect option 1
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- SELECT -->
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="name">Default Select</label>
                        <div class="col-sm-8">
                            <select class="form-control">
                                <option selected>-</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                            </select>
                        </div>
                    </div>



                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
<!--                            $('#submit-button').button('loading')-->
                            <button type="button" id="submit-button" data-loading-text="Loading..."  class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </form>


                <!-- LIST -->

                <!-- SEARCH-->
                <form class="navbar-form navbar-right page-header" role="search">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Search" required="required">
                    </div>
                    <button  type="submit" class="btn btn-default glyphicon glyphicon-search"></button>
                </form>


                <!--TABLE-->
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