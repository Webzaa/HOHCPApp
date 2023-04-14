        <footer class="main-footer">
        </footer>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="{{url('/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
        <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
        <!-- select 2 js -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- bs-custom-file-input -->
        <script src="{{url('/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
        <!-- Select2 -->
        <!-- <script src="{{url('/plugins/select2/js/select2.full.min.js')}}"></script> -->
        <!-- DataTables -->
        <!-- <script type="text/javascript" src="http://documentcloud.github.com/underscore/underscore-min.js"></script> -->
        <script src="{{url('plugins/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{url('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{url('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
        <script src="{{url('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
        <script type="text/javascript" src="https://demo.dashboardpack.com/architectui-html-free/assets/scripts/main.js"></script>

        
        <!-- AdminLTE App -->
        <script src="{{url('/dist/js/adminlte.min.js')}}"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="{{url('/dist/js/demo.js')}}"></script>
        <script>
            $(function() {
                $('.select2').select2();

                $('.select2-tags').select2({
                    tags: true
                })
                var path = $(location).attr('pathname').replace('/', '');
                console.log(path);
                var newpath = path.split('/');
                $("#" + newpath[2]).addClass('active')
            })
        </script>
        <script>
            // $(document).ready(function() {
            //     var max_fields_limit = 10; //set limit for maximum input fields
            //     var x = 1; //initialize counter for text box
            //     $('.add_more_button').click(function(e) { //click event on add more fields button having class add_more_button
            //         e.preventDefault();
            //         if (x < max_fields_limit) { //check conditions
            //             x++; //counter increment
            //             $('.input_fields_container_part').append('<div><input type="text" name="config_wings[]" value="{{old('
            //                 config_wings ')}}" class="{{ ($errors->any() && $errors->first('
            //                 config_wings ')) ? '
            //                 is - invalid ' : '
            //                 '}}" placeholder="Configuration Wings" style="width: 96%; margin-top: 1%;padding: .375rem .75rem;"/><a href="#" class="remove_field btn btn-sm btn-danger" style="margin-left:10px;margin-top: -5px;"><i class="fa fa-times" aria-hidden="true"></i></a></div>'); //add input field
            //         }
            //     });
            //     $('.input_fields_container_part').on("click", ".remove_field", function(e) { //user click on remove text links
            //         e.preventDefault();
            //         $(this).parent('div').remove();
            //         x--;
            //     })
            // });
        </script>
        <script>
            // $(document).ready(function() {
            //     var max_fields_limit = 10; //set limit for maximum input fields
            //     var x = 1; //initialize counter for text box
            //     $('.add_more_button1').click(function(e) { //click event on add more fields button having class add_more_button
            //         e.preventDefault();
            //         if (x < max_fields_limit) { //check conditions
            //             x++; //counter increment
            //             $('.input_fields_container_part1').append('<div><input type="text" name="config_floor_range[]" value="{{old('
            //                 config_floor_range ')}}" class="{{ ($errors->any() && $errors->first('
            //                 config_floor_range ')) ? '
            //                 is - invalid ' : '
            //                 '}}" placeholder="Configuration Floor Range" style="width: 96%; margin-top: 1%;padding: .375rem .75rem;" /><a href="#" class="remove_field btn btn-sm btn-danger" style="margin-left:10px;margin-top: -5px;"><i class="fa fa-times" aria-hidden="true"></i></a></div>'); //add input field
            //         }
            //     });
            //     $('.input_fields_container_part1').on("click", ".remove_field", function(e) { //user click on remove text links
            //         e.preventDefault();
            //         $(this).parent('div').remove();
            //         x--;
            //     })
            // });
        </script>
        <script type="text/javascript">
            $(document).ready(function() {

                $(document).on('click','.logout-dropdown',function(){
                    if($(this).attr('data-class') == 'show'){
                       $(this).attr('data-class','hide');
                       $(".dropdown-menu-right").toggleClass('show')
                    }
                    
                    

                })
                bsCustomFileInput.init();
            });
        </script>
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