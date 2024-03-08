<?php
if (isset($fetched_data)) {
    $user_permissions = json_decode($fetched_data[0]['permissions'], 1);
}
$actions = [
    'create',
    'read',
    'update',
    'delete'
];
?>
<table class="table permission-table" aria-describedby="mydesc">
    <tr>
        <th scope="col">Module/Permissions</th>
        <?php foreach ($actions as $row) { ?>
            <th scope="col"><?= ucfirst($row) ?></th>
        <?php }
        ?>
    </tr>
    <tbody >
        <?php
        foreach ($system_modules as $key => $value) {
            $flag = 0;
            ?>
            <tr>
                <td><?= ucwords(str_replace('_', ' ', $key)) ?></td>
                <?php
                for ($i = 0; $i < count($actions); $i++) {
                    //create,update,delete
                    $index = array_search($actions[$i], $value);
                    if ($index !== false) {
                        $checked = '';
                        if (isset($user_permissions)) {
                            if (isset($user_permissions[$key][$value[$index]])) {
                                $checked = 'checked';
                            } else {
                                $checked = '';
                            }
                        } else {
                            $checked = 'checked';
                        }
                        ?>
                        <td>
                            <input type="checkbox" name="<?= 'permissions[' . $key . '][' . $value[$index] . ']' ?>" <?= $checked; ?> data-plugin="switchery1">

                        </td>
                    <?php } else { ?>
                        <td></td>
                    <?php } ?>
                <?php } ?>
            </tr>
        <?php } ?>

    </tbody>
</table>

<script type="text/javascript">
    $('[data-plugin="switchery1"]').each(function (index, element) {
        var init = new Switchery(element, {
            size: 'small', color: '#1abc9c', secondaryColor: '#f1556c'
        });
    });
</script>