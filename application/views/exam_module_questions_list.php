<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Questions for Exam Quiz | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

        <?php base_url() . include 'include.php'; ?>  
        <script src="https://cdn.ckeditor.com/4.16.2/standard-all/ckeditor.js"></script>
    </head>

    <body>
        <?php
            $exam_id = $this->uri->segment(2);
        ?>
        <div id="app">
            <div class="main-wrapper">
                <?php base_url() . include 'header.php'; ?>  

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>Manage Exam Questions</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <input type="hidden" id="exam_module_id" name="exam_module_id" value="<?= $this->uri->segment(2) ?>"/>
                                            <table aria-describedby="mydesc" class='table-striped' id='question_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/exam_module_questions'?>"
                                                   data-side-pagination="server" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar"
                                                   data-show-columns="true" data-show-refresh="true" 
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"  
                                                   data-pagination-successively-size="3" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "exam-questions-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="category" data-sortable="true" data-visible='false'>Category</th>
                                                        <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'>Sub Category</th>
                                                        <?php if (is_language_mode_enabled()) { ?>
                                                            <th scope="col" data-field="language_id" data-sortable="true" data-visible='false'>Language ID</th>
                                                            <th scope="col" data-field="language" data-sortable="true" data-visible='true'>Language</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="image" data-sortable="false">Image</th>
                                                        <th scope="col" data-field="question" data-sortable="true">Question</th>
                                                        <th scope="col" data-field="question_type" data-sortable="true" data-visible='false' data-formatter="questionTypeFormatter">Question Type</th>
                                                        <th scope="col" data-field="optiona" data-sortable="true">Option A</th>
                                                        <th scope="col" data-field="optionb" data-sortable="true">Option B</th>
                                                        <th scope="col" data-field="optionc" data-sortable="true">Option C</th>
                                                        <th scope="col" data-field="optiond" data-sortable="true">Option D</th>
                                                        <?php if (is_option_e_mode_enabled()) { ?>
                                                            <th scope="col" data-field="optione" data-sortable="true">Option E</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="answer" data-sortable="true" data-visible='false'>Answer</th>
                                                        <th scope="col" data-field="level" data-sortable="true">Level</th>
                                                        <th scope="col" data-field="note" data-sortable="true" data-visible='false'>Note</th>
                                                        <th scope="col" data-field="operate" data-sortable="false">Operate</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </section>
                </div>
            </div>
        </div>

    <?php base_url() . include 'footer.php'; ?>
        <script>
            $(document).ready(function () {
                $('#question_list').on('load-success.bs.table', function () {
                    createCkeditor();
                });
                $('#question_list').on('column-switch.bs.table', function(e, field, checked) {
                    createCkeditor();
                });

                $('#question_list').on('post-body.bs.table', function() {
                    createCkeditor();
                })
            });
        </script>                                                            
        <script type="text/javascript">
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete question? All related questions report will also be deleted')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: base_url + 'delete_exam_module_questions',
                        type: "POST",
                        data: 'id=' + id + '&image_url=' + image,
                        success: function (result) {
                            if (result) {
                                $('#question_list').bootstrapTable('refresh');
                            } else {
                                var PERMISSION_ERROR_MSG = "<?= PERMISSION_ERROR_MSG; ?>";
                                ErrorMsg(PERMISSION_ERROR_MSG);
                            }
                        }
                    });
                }
            });
        </script>

        <script type="text/javascript">
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    "exam_module_id": $('#exam_module_id').val(),
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
        </script>


    </body>
</html>