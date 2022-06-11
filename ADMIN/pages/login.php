<?PHP include "adminHeader.php";?>        <!-- Page Content -->
    <div id="page-wrapper"> 
        <div class="container" style="margin-top:100px;">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="panel panel-warning ">
                        <div class="panel-heading">
                            Login
                        </div>
                        <div class="panel-body">
                            <form action="loginData.php" method = "post">
                                <fieldset>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="E-mail" name="admin_email"  autofocus required>
                                    </div>
                                    <div class="form-group">
                                        <input class="form-control" placeholder="Password" name="admin_password"  value="" required>
                                    </div>
                                    
                                        <!-- Change this to a button or input when using this as a form -->
                                    <input type = "submit" name = "submit" class="btn btn-lg btn-success btn-block">
                                    <p class="text-warning"></p>
                                </fieldset>
                            </form>
                        </div>
                        <div class="panel-footer">
                        Panel Footer
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>    
        <!-- /#wrapper -->

        <!-- jQuery -->
        <?php require "adminFooter.php";?>