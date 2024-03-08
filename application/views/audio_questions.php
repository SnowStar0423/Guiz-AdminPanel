<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Audio Questions for Quiz | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

        <?php base_url() . include 'include.php'; ?>  
    </head>

    <body>
        <div id="app">
            <div class="main-wrapper">
                <?php base_url() . include 'header.php'; ?>  

                <!-- Main Content -->
                <div class="main-content">
                    <section class="section">
                        <div class="section-header">
                            <h1>Create and Manage Audio Questions</h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Create Audio Questions</h4>
                                        </div>
                                        <div class="card-body">
                                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <?php
                                                $sess_language_id = '0';
                                                $sess_category = '0';
                                                $sess_subcategory = '0';
                                                if ($this->session->userdata()) {
                                                    $type = $this->uri->segment(1);
                                                    $sess_data = $this->session->userdata("$type");
                                                    if (!empty($sess_data)) {
                                                        $sess_language_id = $sess_data['language_id'];
                                                        $sess_category = $sess_data['category'];
                                                        $sess_subcategory = $sess_data['subcategory'];
                                                    }
                                                }
                                                ?>
                                                <div class="form-group row">                                               
                                                    <?php if (is_language_mode_enabled()) { ?>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Language</label>
                                                            <select name="language_id" id="language_id" class="form-control" required>
                                                                <option value="">Select Language</option>
                                                                <?php foreach ($language as $lang) { ?>
                                                                    <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                                <?php } ?> 
                                                            </select>
                                                        </div>    
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Main Category</label>
                                                            <select id="category" name="category" class="form-control" required>
                                                                <option value="">Select Main Category</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 col-sm-12">
                                                            <label class="control-label">Sub Category</label>
                                                            <select id="subcategory" name="subcategory" class="form-control">
                                                                <option value="">Select Sub Category</option>
                                                            </select>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Main Category</label>
                                                            <select id="category" name="category" class="form-control" required>
                                                                <option value="">Select Main Category</option>
                                                                <?php foreach ($category as $cat) { ?>
                                                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                                <?php } ?> 
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <label class="control-label">Sub Category</label>
                                                            <select id="subcategory" name="subcategory" class="form-control">
                                                                <option value="">Select Sub Category</option>
                                                            </select>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Question</label>
                                                        <textarea id="question" name="question" class="form-control" required></textarea>
                                                    </div>                                                   
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-3 col-sm-12">  
                                                        <label class="control-label">Question Type</label>
                                                        <div>
                                                            <div class="form-check-inline bg-light p-2">
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="question_type" value="1" checked required>Options
                                                                </label>
                                                                <label class="form-check-label">
                                                                    <input type="radio" class="form-check-input" name="question_type" value="2">True / False
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 col-sm-12">
                                                        <label class="control-label">Audio Type</label>
                                                        <select class="form-control" id="audio_type" name="audio_type" required>
                                                            <option value="1">Audio (other url)</option>
                                                            <option value="2">Audio Uploaded</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12" id="audio_upload">
                                                        <label class="control-label">Audio for Question <small>( if any )</small></label>
                                                        <input id="file" name="file" type="file" accept="audio/*" class="form-control">
                                                        <small class="text-danger">Audio type supported (mp3,mp4,ogv,wav,aac,msv,wma,ogg)</small>
                                                        <div style="display: none" id="audio_error_msg" class="alert alert-danger" ></div>
                                                        <!--Duration: <input type='text' name='f_du' id='f_du' size='5' /> seconds-->
                                                    </div>    
                                                    <div class="col-md-6 col-sm-12" id="audio_link">
                                                        <label class="control-label">Audio Link </label>
                                                        <input id="audio_type_url" name="audio_type_url" type="url" class="form-control">

                                                    </div> 
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option A</label>                                                
                                                        <input class="form-control" type="text" id="a" name="a" required>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6">
                                                        <label class="control-label">Option B</label>
                                                        <input class="form-control" type="text" id="b" name="b" required>
                                                    </div>
                                                </div>
                                                <div id="tf">
                                                    <div class="form-group row">                                                   
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option C</label>
                                                            <input class="form-control" type="text" id="c" name="c" required>
                                                        </div>                                                    
                                                        <div class="col-md-6 col-sm-6">
                                                            <label class="control-label">Option D</label>
                                                            <input class="form-control" type="text" id="d" name="d" required>
                                                        </div>
                                                    </div>
                                                    <?php if (is_option_e_mode_enabled()) { ?>
                                                        <div class="form-group row">                                                        
                                                            <div class="col-md-6 col-sm-12">
                                                                <label class="control-label">Option E</label>
                                                                <input class="form-control" type="text" id="e" name="e" required>
                                                            </div> 
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Answer</label>                                                  
                                                        <select name='answer' id='answer' class='form-control' required>
                                                            <option value=''>Select Right Answer</option>
                                                            <option value='a'>A</option>
                                                            <option value='b'>B</option>
                                                            <option class='ntf' value='c'>C</option>
                                                            <option class='ntf' value='d'>D</option>
                                                            <?php if (is_option_e_mode_enabled()) { ?>
                                                                <option class='ntf' value='e'>E</option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>                          
                                                </div>
                                                <div class="form-group row">                                                    
                                                    <div class="col-md-12 col-sm-12">
                                                        <label class="control-label">Note</label>
                                                        <small>(this will be showing with review section only)</small>
                                                        <textarea name='note' class='form-control'></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="btnadd" value="Submit" class="<?= BUTTON_CLASS ?>"/>
                                                    </div>
                                                </div>
                                            </form>
                                            <audio id='audio'></audio> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Questions of Quiz <small>View / Update / Delete</small></h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <?php if (is_language_mode_enabled()) { ?>                                                  
                                                    <div class="col-md-3">
                                                        <select id="filter_language" class="form-control" required>
                                                            <option value="">Select Language</option>
                                                            <?php foreach ($language as $lang) { ?>
                                                                <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <select id="filter_category" class="form-control" required>
                                                            <option value="">Select Main Category</option>

                                                        </select>
                                                    </div>
                                                <?php } else { ?>
                                                    <div class="col-md-3">
                                                        <select id="filter_category" class="form-control" required>
                                                            <option value="">Select Main Category</option>
                                                            <?php foreach ($category as $cat) { ?>
                                                                <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                            <?php } ?> 
                                                        </select>
                                                    </div>
                                                <?php } ?>
                                                <div class='col-md-3'>
                                                    <select id='filter_subcategory' class='form-control' required>
                                                        <option value=''>Select Sub Category</option>
                                                    </select>
                                                </div>
                                                <div class='col-md-3'>
                                                    <button class='<?= BUTTON_CLASS ?> btn-block form-control' id='filter_btn'>Filter Data</button>
                                                </div>
                                            </div>
                                            <div id="toolbar">
                                                <?php if (has_permissions('delete', 'audio_question')) { ?>
                                                    <button class="btn btn-danger"  id="delete_multiple_questions" title="Delete Selected Questions"><em class='fa fa-trash'></em></button>					  
                                                <?php } ?>
                                            </div> 
                                            <table aria-describedby="mydesc" class='table-striped' id='question_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/audio_question' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="id" data-sort-order="desc"       
                                                   data-pagination-successively-size="3" data-maintain-selected="true" 
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "audio-question-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="state" data-checkbox="true"></th>
                                                        <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                        <th scope="col" data-field="category" data-sortable="true" data-visible='false'>Category</th>
                                                        <th scope="col" data-field="subcategory" data-sortable="true" data-visible='false'>Sub Category</th>
                                                        <?php if (is_language_mode_enabled()) { ?>
                                                            <th scope="col" data-field="language_id" data-sortable="true" data-visible='false'>Language ID</th>
                                                            <th scope="col" data-field="language" data-sortable="true" data-visible='true'>Language</th>
                                                        <?php } ?>
                                                        <th scope="col" data-field="audio_type" data-sortable="false" data-visible='false'>Audio Type</th>
                                                        <th scope="col" data-field="audio" data-align="center" data-sortable="false">Audio</th>
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
                                                        <th scope="col" data-field="note" data-sortable="true" data-visible='false'>Note</th>
                                                        <th scope="col" data-field="operate" data-sortable="false" data-events="actionEvents">Operate</th>
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

        <div class="modal fade" tabindex="-1" role="dialog" id="editDataModal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Audio Question</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <form method="post" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                <input type='hidden' name="edit_id" id="edit_id" value="" />
                                <input type="hidden" name='audio_url' id="audio_url" value="" />
                                <input type="hidden" name='edit_question_type' value="" />
                                <div class="form-group row">                                               
                                    <?php if (is_language_mode_enabled()) { ?>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="control-label">Language</label>
                                            <select name="language_id" id="update_language_id" class="form-control" required>
                                                <option value="">Select Language</option>
                                                <?php foreach ($language as $lang) { ?>
                                                    <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>    
                                        <div class="col-md-4 col-sm-12">
                                            <label class="control-label">Main Category</label>
                                            <select id="edit_category" name="category" class="form-control" required>
                                                <option value="">Select Main Category</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-sm-12">
                                            <label class="control-label">Sub Category</label>
                                            <select id="edit_subcategory" name="subcategory" class="form-control">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                    <?php } else { ?>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="control-label">Main Category</label>
                                            <select id="edit_category" name="category" class="form-control" required>
                                                <option value="">Select Main Category</option>
                                                <?php foreach ($category as $cat) { ?>
                                                    <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <label class="control-label">Sub Category</label>
                                            <select id="edit_subcategory" name="subcategory" class="form-control">
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Question</label>
                                        <textarea id="edit_question" name="question" class="form-control" required></textarea>
                                    </div>                                                   
                                </div>                                
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-12">
                                        <label class="control-label">Audio Type</label>
                                        <select class="form-control" id="up_audio_type" name="audio_type" required>
                                            <option value="1">Audio (other url)</option>
                                            <option value="2">Audio Uploaded</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-12" id="up_audio_upload">
                                        <label class="control-label">Audio for Question <small>( if any )</small></label>
                                        <input id="up_file" name="update_file" type="file" accept="audio/*" class="form-control">
                                        <small class="text-danger">Audio type supported (mp3,mp4,ogv,wav,aac,msv,wav,wma,ogg)</small>
                                        <p style="display: none" id="up_audio_error_msg" class="badge badge-danger"></p>
                                    </div>    
                                    <div class="col-md-6 col-sm-12" id="up_audio_link">
                                        <label class="control-label">Audio Link </label>
                                        <input id="up_audio_type_url" name="audio_type_url" type="url" class="form-control">
                                    </div> 
                                </div>
                                <!-- <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">  
                                        <label class="control-label">Question Type</label>
                                        <div>
                                            <div class="form-check-inline bg-light p-2">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="edit_question_type" value="1" checked required>Options
                                                </label>

                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="edit_question_type" value="2">True / False
                                                </label>
                                            </div>
                                        </div>                                                             
                                    </div>
                                </div> -->
                                <div class="form-group row">
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Option A</label>                                                
                                        <input class="form-control" type="text" id="edit_a" name="a" required>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <label class="control-label">Option B</label>
                                        <input class="form-control" type="text" id="edit_b" name="b" required>
                                    </div>
                                </div>
                                <div id="edit_tf">
                                    <div class="form-group row">                                                   
                                        <div class="col-md-6 col-sm-6">
                                            <label class="control-label">Option C</label>
                                            <input class="form-control" type="text" id="edit_c" name="c" required>
                                        </div>                                                    
                                        <div class="col-md-6 col-sm-6">
                                            <label class="control-label">Option D</label>
                                            <input class="form-control" type="text" id="edit_d" name="d" required>
                                        </div>
                                    </div>
                                    <?php if (is_option_e_mode_enabled()) { ?>
                                        <div class="form-group row">                                                        
                                            <div class="col-md-6 col-sm-12">
                                                <label class="control-label">Option E</label>
                                                <input class="form-control" type="text" id="edit_e" name="e" required>
                                            </div> 
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Answer</label>                                                  
                                        <select name='answer' id='edit_answer' class='form-control' required>
                                            <option value=''>Select Right Answer</option>
                                            <option value='a'>A</option>
                                            <option value='b'>B</option>
                                            <option class='edit_ntf' value='c'>C</option>
                                            <option class='edit_ntf' value='d'>D</option>
                                            <?php if (is_option_e_mode_enabled()) { ?>
                                                <option class='edit_ntf' value='e'>E</option>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div>
                                <div class="form-group row">                                                    
                                    <div class="col-md-12 col-sm-12">
                                        <label class="control-label">Note</label>
                                        <textarea name='note' id="edit_note" class='form-control'></textarea>
                                    </div>
                                </div>
                                <div class="float-right">                                    
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input name="btnupdate" type="submit" value="Save changes" class="<?= BUTTON_CLASS ?>">
                                </div>
                            </form>
                            <audio id="up_audio"></audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php base_url() . include 'footer.php'; ?>  
        <script>
            $(document).on('click', '.playbtn', function () {
                var x = $(this).attr('data-id');
                var audio = document.getElementById(x);
                if ($(this).hasClass('fa-play')) {
                    $('.playbtn').addClass('fa-play');
                    $(this).removeClass('fa-play');
                    $(this).addClass('fa-pause');
                    audio.play();
                } else {
                    audio.pause();
                    $(this).removeClass('fa-pause');
                    $(this).addClass('fa-play');
                }
                audio.onended = function () {
                    $(".playbtn").removeClass('fa-pause');
                    $(".playbtn").addClass('fa-play');
                };
            });
        </script>

        <script type="text/javascript">
            window.actionEvents = {
                'click .edit-data': function (e, value, row, index) {
                    $('#edit_id').val(row.id);
                    $('#audio_url').val(row.audio_url);
                    $('#up_audio_type').val(row.audio_type);
                    if (row.audio_type == '2')
                    {
                        $('#up_audio_upload').show();
                        $('#up_audio_type_url').removeAttr("required", "required");
                        $('#up_audio_link').hide();
//                        
                    } else
                    {
                        $('#up_audio_type_url').val(row.audio_url);
                        $('#up_audio_link').show();
                        $('#up_audio_type_url').attr("required", "required");
                        $('#up_audio_upload').hide();
                    }
                    $('#edit_question').val(row.question);
<?php if (is_language_mode_enabled()) { ?>
                        if (row.language_id == 0) {
                            $('#update_language_id').val(row.language_id);
                            $('#edit_category').html(category_options);
                            $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
                        } else {
                            $('#update_language_id').val(row.language_id).trigger("change", [row.language_id, row.category, row.subcategory]);
                        }
<?php } else { ?>
                        $('#edit_category').val(row.category).trigger("change", [row.category, row.subcategory]);
<?php } ?>
                    var question_type = row.question_type;
                    if (question_type == "2") {
                        $("input[name=edit_question_type]").val(2);
                        $('#edit_tf').hide('fast');
                        $('#edit_a').val(row.optiona);
                        $('#edit_b').val(row.optionb);
                        $('.edit_ntf').hide('fast');
                        $('#edit_c').removeAttr('required');
                        $('#edit_d').removeAttr('required');
                        $('#edit_e').removeAttr('required');
                    } else {
                        $("input[name=edit_question_type]").val(1);
                        $('#edit_a').val(row.optiona);
                        $('#edit_b').val(row.optionb);
                        $('#edit_c').val(row.optionc);
                        $('#edit_d').val(row.optiond);
<?php if (is_option_e_mode_enabled()) { ?>
                            $('#edit_e').val(row.optione);
<?php } ?>
                        $('#edit_tf').show('fast');
                        $('.edit_ntf').show('fast');
                        $('#edit_c').attr("required", "required");
                        $('#edit_d').attr("required", "required");
                        $('#edit_e').attr("required", "required");
                    }

                    $('#edit_a').val(row.optiona);
                    $('#edit_b').val(row.optionb);
                    $('#edit_c').val(row.optionc);
                    $('#edit_d').val(row.optiond);
<?php if (is_option_e_mode_enabled()) { ?>
                        $('#edit_e').val(row.optione);
<?php } ?>
                    $('#edit_answer').val(row.answer.toLowerCase());
                    $('#edit_note').val(row.note);
                    $('#edit_subcategory').val(row.subcategory);
                }
            };
        </script>

        <script type="text/javascript">
            $('#audio_upload').hide();
            $('#audio_link').show();
            $('#audio_type_url').attr("required", "required");
            $('#audio_type').on('change', function () {
                var type = $('#audio_type').val();
                if (type == '2') {
                    $('#audio_upload').show();
                    $('#file').attr("required", "required");
                    $('#audio_type_url').removeAttr("required", "required");
                    $('#audio_link').hide();
                } else {
                    $('#audio_link').show();
                    $('#file').removeAttr("required", "required");
                    $('#audio_type_url').attr("required", "required");
                    $('#audio_upload').hide();
                }
            });


            $('#up_audio_upload').hide();
            $('#up_audio_link').show();
            $('#up_audio_type_url').attr("required", "required");
            $('#up_audio_type').on('change', function () {
                var type = $('#up_audio_type').val();
                if (type == '2') {
                    $('#up_audio_upload').show();
                    $('#up_audio_link').hide();
                    $('#up_audio_type_url').removeAttr("required", "required");
                } else {
                    $('#up_audio_link').show();
                    $('#up_audio_upload').hide();
                    $('#up_audio_type_url').attr("required", "required");
                }
            });

            $('#filter_btn').on('click', function (e) {
                $('#question_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_questions').on('click', function (e) {
                var base_url = "<?php echo base_url(); ?>";
                sec = 'tbl_audio_question';
                is_image = 1;
                table = $('#question_list');
                delete_button = $('#delete_multiple_questions');
                selected = table.bootstrapTable('getSelections');
                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1);
                if (ids == "") {
                    alert("Please select some questions to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected questions?")) {
                        $.ajax({
                            type: "POST",
                            url: base_url + 'delete_multiple',
                            data: 'ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("Audio Questions deleted successfully");
                                } else {
                                    alert("Could not delete Audio Questions. Try again!");
                                }
                                delete_button.html('<i class="fa fa-trash"></i>');
                                table.bootstrapTable('refresh');
                            }
                        });
                    }
                }
            });
        </script>

        <script type="text/javascript">
            $(document).on('click', '.delete-data', function () {
                if (confirm('Are you sure? Want to delete question? All related questions report will also be deleted')) {
                    var base_url = "<?php echo base_url(); ?>";
                    id = $(this).data("id");
                    audio = $(this).attr("data-audio");
                    $.ajax({
                        url: base_url + 'delete_audio_question',
                        type: "POST",
                        data: 'id=' + id + '&audio_url=' + audio,
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
            var base_url = "<?php echo base_url(); ?>";
            var type = 'audio-question-subcategory';

            var sess_language_id = '<?= $sess_language_id ?>';
            var sess_category = '<?= $sess_category ?>';
            var sess_subcategory = '<?= $sess_subcategory ?>';
            $(document).ready(function () {
                if (sess_language_id != '0' || sess_category != '0') {
<?php if (is_language_mode_enabled()) { ?>
                        $('#language_id').val(sess_language_id).trigger("change", [sess_language_id, sess_category, sess_subcategory]);
<?php } else { ?>
                        $('#category').val(sess_category).trigger("change", [sess_category, sess_subcategory]);
<?php } ?>
                }
            });

            $('#language_id').on('change', function (e, row_language_id, row_category, row_subcategory) {
                var language_id = $('#language_id').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#category').html(result).trigger("change");
                        if (language_id == row_language_id && row_category != 0)
                            $('#category').val(row_category).trigger("change", [row_category, row_subcategory]);
                    }
                });
            });

            $('#update_language_id').on('change', function (e, row_language_id, row_category, row_subcategory) {
                var language_id = $('#update_language_id').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#edit_category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#edit_category').html(result).trigger("change");
                        if (language_id == row_language_id && row_category != 0)
                            $('#edit_category').val(row_category).trigger("change", [row_category, row_subcategory]);
                    }
                });
            });

            $('#filter_language').on('change', function (e) {
                var language_id = $('#filter_language').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type,
                    beforeSend: function () {
                        $('#filter_category').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#filter_category').html(result);
                    }
                });
            });

            category_options = '';
<?php
$category_options = "<option value=''>Select Category</option>";
foreach ($category as $cat) {
    $category_options .= "<option value=" . $cat->id . ">" . $cat->category_name . "</option>";
}
?>
            category_options = "<?= $category_options; ?>";

            $('#category').on('change', function (e, row_category, row_subcategroy) {
                var category_id = $('#category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#subcategory').html(result);
                        if (category_id == row_category && row_subcategroy != 0)
                            $('#subcategory').val(row_subcategroy);
                    }
                });
            });

            $('#edit_category').on('change', function (e, row_category, row_subcategroy) {
                var category_id = $('#edit_category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#edit_subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#edit_subcategory').html(result);
                        if (category_id == row_category && row_subcategroy != 0)
                            $('#edit_subcategory').val(row_subcategroy);
                    }
                });
            });

            $('#filter_category').on('change', function (e) {
                var category_id = $('#filter_category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id,
                    beforeSend: function () {
                        $('#filter_subcategory').html('<option value="">Please wait..</option>');
                    },
                    success: function (result) {
                        $('#filter_subcategory').html(result);
                    }
                });
            });
        </script>       

        <script type="text/javascript">
            $('input[name="question_type"]').on("click", function (e) {
                var question_type = $(this).val();
                if (question_type == "2") {
                    $('#tf').hide('fast');
                    $('#a').val("<?= is_settings('true_value') ?>");
                    $('#b').val("<?= is_settings('false_value') ?>");
                    $('#c').removeAttr('required');
                    $('#d').removeAttr('required');
                    $('#e').removeAttr('required');
                    $('.ntf').hide('fast');
                } else {
                    $('#a').val('');
                    $('#b').val('');
                    $('#tf').show('fast');
                    $('.ntf').show('fast');
                    $('#c').attr("required", "required");
                    $('#d').attr("required", "required");
                    $('#e').attr("required", "required");
                }
            });

            $('input[name="edit_question_type"]').on("click", function (e) {
                var edit_question_type = $(this).val();

                if (edit_question_type == "2") {
                    $('#edit_tf').hide('fast');
                    $('#edit_a').val("<?= is_settings('true_value') ?>");
                    $('#edit_b').val("<?= is_settings('false_value') ?>");
                    $('#edit_c').removeAttr('required');
                    $('#edit_d').removeAttr('required');
                    $('#edit_e').removeAttr('required');
                    $('.edit_ntf').hide('fast');
                    $('#edit_answer').val('');
                } else {
                    $('#edit_tf').show('fast');
                    $('.edit_ntf').show('fast');
                    $('#edit_c').attr("required", "required");
                    $('#edit_d').attr("required", "required");
                    $('#edit_e').attr("required", "required");
                }
            });
        </script>

        <script type="text/javascript">
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    "category": $('#filter_category').val(),
                    "subcategory": $('#filter_subcategory').val(),
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    limit: p.limit,
                    search: p.search
                };
            }
        </script>

        <script type="text/javascript">
            var f_duration = 0; //store duration 
            var limit =<?php echo ($total_audio_time) ? $total_audio_time['message'] : "60" ?>;
            document.getElementById('audio').addEventListener('canplaythrough', function (e) {
                //add duration in the input field #f_du 
                console.log(e.currentTarget);
                f_duration = Math.round(e.currentTarget.duration);
//                document.getElementById('f_du').value = f_duration;
                URL.revokeObjectURL(obUrl);
                if (f_duration > limit)
                {
                    $('#file').val('');
                    $('#audio_error_msg').html('<?= AUDIO_TIME_ERROR; ?>');
                    $('#audio_error_msg').show().delay(3000).fadeOut();
                }
            });

//when select a file, create an ObjectURL with the file and add it in the #audio element 
            var obUrl;
            document.getElementById('file').addEventListener('change', function (e) {
                var file = e.currentTarget.files[0];
                //check file extension for audio/video type 
                if (file.name.match(/\.(mp3|mp4|ogv|wav|aac|msv|wav|wma|ogg|MP3|MP4|OGV|WAV|AAC|MSV|WAV|WMA|OGG)$/i)) {
                    obUrl = URL.createObjectURL(file);
                    document.getElementById('audio').setAttribute('src', obUrl);
                }
            });
        </script>


        <script type="text/javascript">
            var f_duration = 0; //store duration 
            var limit =<?php echo ($total_audio_time) ? $total_audio_time['message'] : "60" ?>;
            document.getElementById('up_audio').addEventListener('canplaythrough', function (e) {
                //add duration in the input field #f_du 
                f_duration = Math.round(e.currentTarget.duration);
//                document.getElementById('f_du').value = f_duration;
                URL.revokeObjectURL(obUrl);
                if (f_duration > limit)
                {
                    $('#up_file').val('');
                }
            });

//when select a file, create an ObjectURL with the file and add it in the #audio element 
            var obUrl;
            document.getElementById('up_file').addEventListener('change', function (e) {
                var file = e.currentTarget.files[0];
                //check file extension for audio/video type 
                if (file.name.match(/\.(mp3|mp4|ogv|wav|aac|msv|wav|wma|ogg|MP3|MP4|OGV|WAV|AAC|MSV|WAV|WMA|OGG)$/i)) {
                    obUrl = URL.createObjectURL(file);
                    document.getElementById('up_audio').setAttribute('src', obUrl);
                }
            });
        </script>

    </body>
</html>