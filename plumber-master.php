<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>category</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    include_once("include/commoncss.php");
    ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <?php
        include_once("include/header.php");
        include_once("include/sidebar.php");

        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Plumber-Master</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">plumber master</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- <div class="card-header">
              <h3 class="card-title">DataTable with minimal features & hover style</h3>
            </div> -->
                            <!-- /.card-header -->
                            <div class="col-md-12 pt-3">
                                <div class="card card-primary">

                                    <div class="card-body">
                                        <!-- Date range -->
                                        <div class="row">
                                            <div class="col-3 form-group">
                                                <div class="form-group">
                                                    <label>Category</label>
                                                    <select name="category" class="form-control select2"
                                                        style="width: 100%;">
                                                        <option selected="selected">Select Category </option>
                                                        <option>Category-1</option>
                                                        <option>Category-2</option>
                                                        <option>Category-3</option>
                                                        <option>Category-4</option>
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-3  form-group">


                                                <label>Name</label>
                                                <input type="text" name="category_name" id="category_name"
                                                    class="form-control" placeholder="Enter Name">


                                            </div>
                                            <div class="col-3 form-group">
                                                <label>Description</label>
                                                <input type="text" name="description" id="description"
                                                    class="form-control" placeholder="Decription..">


                                            </div>
                                            <div class="col-3 text-center mt-4 mb-2">
                                                <a href="#" class="btn  btn-primary">Save</a>
                                                <a href="#" class="btn btn-danger ">Cancel</a>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>

                            <div class="card-body">

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Id</th>
                                            <th>Plumber Name</th>
                                            <th>Description..</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Category 1</td>
                                            <td>Description..</td>
                                            <td class="text-center-block py-0 align-middle">
                                                <div class="">
                                                    <a href="#" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Category 2</td>
                                            <td>Description..</td>
                                            <td class="text-center-block py-0 align-middle">
                                                <div class="">
                                                    <a href="#" class="btn btn-warning btn-sm">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="#" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>


                                </table>
                            </div>
                        </div>

                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.col -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->

        <?php

        include_once("include/jquery.php");

        ?>

        <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
        </script>
</body>

</html>
</script>
</body>

</html>