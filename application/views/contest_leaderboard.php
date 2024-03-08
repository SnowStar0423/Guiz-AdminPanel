<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Contest Leaderboard | <?php echo ($app_name) ? $app_name['message'] : "" ?></title>   

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
                            <h1>Contest Leaderboard <small> Contest wise top users</small></h1>
                        </div>
                        <div class="section-body">

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" id="contest_id" name="contest_id" value="<?= $this->uri->segment(2) ?>"/>
                                            <table aria-describedby="mydesc" class='table-striped' id='leaderboard_list' 
                                                   data-toggle="table" data-url="<?= base_url() . 'Table/contest_leaderboard' ?>"
                                                   data-click-to-select="true" data-side-pagination="server" 
                                                   data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200, All]" 
                                                   data-search="true" data-toolbar="#toolbar" 
                                                   data-show-columns="true" data-show-refresh="true"
                                                   data-trim-on-search="false" data-mobile-responsive="true"
                                                   data-sort-name="user_rank" data-sort-order="asc"  
                                                   data-pagination-successively-size="3" data-maintain-selected="true"
                                                   data-show-export="true" data-export-types='["csv","excel","pdf"]'
                                                   data-export-options='{ "fileName": "contest-leaderboard-list-<?= date('d-m-y') ?>" }'
                                                   data-query-params="queryParams">
                                                <thead>
                                                    <tr>
                                                        <th scope="col" data-field="id" data-sortable="true" data-align="center">ID</th>
                                                        <th scope="col" data-field="name" data-sortable="true">Name</th>
                                                        <th scope="col" data-field="user_id" data-sortable="true" data-visible="false">User ID</th>
                                                        <th scope="col" data-field="contest_id" data-sortable="true" data-visible="false">Contest ID</th>
                                                        <th scope="col" data-field="questions_attended" data-sortable="true">Questions Attended</th>
                                                        <th scope="col" data-field="correct_answers" data-sortable="true">Correct Answers</th>
                                                        <th scope="col" data-field="score" data-sortable="true">Score</th>
                                                        <th scope="col" data-field="user_rank" data-sortable="true">Rank</th>
                                                        <th scope="col" data-field="last_updated" data-sortable="true">Last Updated</th>
                                                        <th scope="col" data-field="date_created" data-sortable="true">Date Created</th></tr>
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

        <script type="text/javascript">
            window.actionEvents = {
            };
        </script>

        <script type="text/javascript">
            function queryParams(p) {
                return {
                    "contest_id": $('#contest_id').val(),
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