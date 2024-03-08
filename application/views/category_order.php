<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Category Order | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Category Order Settings <small class="text-small">Update Category Order here</small></h1>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="row mt-4">
                                            <?php if (is_language_mode_enabled()) { ?>                                       
                                                <div class='col-md-10 offset-1'>
                                                    <select id='filter_language' class='form-control' required>
                                                        <option value=''>Select language</option>
                                                        <?php foreach ($language as $lang) { ?>
                                                            <option value="<?= $lang->id ?>"><?= $lang->language ?></option>
                                                        <?php } ?> 
                                                    </select>
                                                </div>                                       
                                            <?php } ?>
                                        </div>
                                        <div class="card-header">
                                            <h4>Main Category</h4>
                                        </div>
                                        <div class="card-body">

                                            <form method="post" class="needs-validation" onsubmit="return saveOrder()">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required/>
                                                <div class="form-group row" style="overflow-y:scroll;height:400px;">

                                                    <div class="col-12">
                                                        <input type="hidden" name="row_order" id="row_order" required readonly/> 
                                                        <ol id="sortable-row">
                                                            <?php foreach ($category as $cat) { ?>
                                                                <li id=<?php echo $cat->id; ?>>
                                                                    <?php if (!empty($cat->image)) { ?>
                                                                        <img src="<?= CATEGORY_IMG_PATH . $cat->image ?>" alt="category" height=30 />&nbsp;<?= $cat->category_name ?>
                                                                    <?php } else { ?>
                                                                        <img src="<?= base_url() . LOGO_IMG_PATH . $half_logo['message']; ?>" height=30 alt="category"/>&nbsp;<?= $cat->category_name ?>
                                                                    <?php } ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="form-group row float-right">
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="btnaddcategory" value="Submit"  class="<?= BUTTON_CLASS ?>"/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="row mt-4">
                                            <div class='col-md-10 offset-1'>
                                                <select id='filter_category' class='form-control' required>
                                                    <option value=''>Select Main Category</option>
                                                    <?php foreach ($category as $cat) { ?>
                                                        <option value="<?= $cat->id ?>"><?= $cat->category_name ?></option>
                                                    <?php } ?>  
                                                </select>
                                            </div>
                                        </div>
                                        <div class="card-header">
                                            <h4>Sub Category</h4>
                                        </div>
                                        <div class="card-body">

                                            <form method="post" class="needs-validation" onsubmit="return saveOrder1()">
                                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>">
                                                <input type="hidden" name="type" value="<?= $this->uri->segment(1) ?>" required/>
                                                <div class="form-group row" style="overflow-y:scroll;height:400px;">

                                                    <div class="col-12">
                                                        <input type="hidden" name="row_order1" id="row_order1" required readonly/> 
                                                        <ol id="sortable-row-1">
                                                            <?php foreach ($subcategory as $subcat) { ?>
                                                                <li id=<?php echo $subcat->id; ?>>
                                                                    <?php if (!empty($subcat->image)) { ?>
                                                                        <img src="<?= SUBCATEGORY_IMG_PATH . $subcat->image ?>" alt="subcategory" height=30 />&nbsp;<?= $subcat->subcategory_name ?>
                                                                    <?php } else { ?>
                                                                        <img src="<?= base_url() . LOGO_IMG_PATH . $half_logo['message']; ?>" height=30 alt="subcategory"/>&nbsp;<?= $subcat->subcategory_name ?>
                                                                    <?php } ?>
                                                                </li>
                                                            <?php } ?>
                                                        </ol>
                                                    </div>

                                                </div>

                                                <div class="form-group row float-right">
                                                    <div class="col-sm-12">
                                                        <input type="submit" name="btnaddsubcategory" value="Submit"  class="<?= BUTTON_CLASS ?>"/>
                                                    </div>
                                                </div>
                                            </form>
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

        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <script type="text/javascript">
                                                $(function () {
                                                    $("#sortable-row").sortable();
                                                    $("#sortable-row-1").sortable();
                                                });

        </script>
        <script type="text/javascript">
            function saveOrder() {
                var selectedLanguage = new Array();
                $('ol#sortable-row li').each(function () {
                    selectedLanguage.push($(this).attr("id"));
                });
                document.getElementById("row_order").value = selectedLanguage;
            }
            function saveOrder1() {
                var selectedLanguage = new Array();
                $('ol#sortable-row-1 li').each(function () {
                    selectedLanguage.push($(this).attr("id"));
                });
                document.getElementById("row_order1").value = selectedLanguage;
            }
        </script>
        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var type = '<?= $this->uri->segment(1) ?>';

            $('#filter_language').on('change', function (e) {
                var language_id = $('#filter_language').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_categories_of_language',
                    data: 'language_id=' + language_id + '&type=' + type + '&sortable=sortable',
                    success: function (result) {
                        $('#sortable-row').html(result);
                    }
                });
            });

            $('#filter_category').on('change', function (e) {
                var category_id = $('#filter_category').val();
                $.ajax({
                    type: 'POST',
                    url: base_url + 'get_subcategories_of_category',
                    data: 'category_id=' + category_id + '&sortable=sortable',
                    success: function (result) {
                        $('#sortable-row-1').html(result);
                    }
                });
            });
        </script>

    </body>
</html>