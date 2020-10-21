<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">

</head>

<body>
    <div class="container" style="margin-top: 25px;">

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">
            Create New
        </button>
        <div>
            <div class="list-group list-group-root categoies">
                <?= printTree($categories) ?>
            </div>

        </div>
    </div>

    <?php

    function printTree(array $data, $markup = '')
    {
        foreach ($data as $element) {
            echo '<p class="list-group-item" id="item-' . $element['id'] . '">'  . $element['name'] . ' <span class="add-btn" onclick="openModal(' . $element['id'] . ')"> <i class="fa fa-plus-circle" aria-hidden="true"></i></span> </p>';
            if (isset($element['children'])) {
                echo '<div class="list-group">';
                printTree($element['children'], $markup);
                echo '</div>';
            }
            // print '</div>';
        }
    }
    ?>
    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form id="createForm">
                        <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Enter category name">
                        </div>
                        <button type="submit" class="btn btn-primary create">Submit</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    // Ajax post
    function openModal(id = null) {
        $('#modal').modal('show')

        var input = document.createElement("input");

        input.setAttribute("type", "hidden");

        input.setAttribute("name", "parent_id");
        input.setAttribute("id", "parent_id");
        input.setAttribute("value", id);

        //append to form element that you want .
        document.getElementById('createForm').appendChild(input);
    }

    function create(name, parent = null) {
        event.preventDefault();
        var _name = $("input#name").val();

    }
    $(document).ready(function() {



        $(".create").click(function(event) {
            event.preventDefault();
            var name = $("input#name").val();
            // var password = $("input#pwd").val();
            var parent_id = $("input#parent_id").val()
            jQuery.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>" + "/category/save",
                dataType: 'json',
                data: {
                    name,
                    parent_id
                },
                success: function(res) {
                    if (res) {
                        location.reload();
                        // Append to list

                         
                        // var list = parent_id !== null ? $(`#item-${parent_id}`) : $('.categoies')
                        // console.log('list', list);

                        // var ele = `<p class="list-group-item" id="${res.id}"> ${name} <span class="add-btn" onclick="openModal(${res.id})"> <i class="fa fa-plus-circle" aria-hidden="true"></i></span></p>`
                        // console.log('ele', ele);
                        // list.append(ele)

                        // $('#modal').modal('hide')
                    }
                }
            });
        });
    });
</script>

</html>



<style>
    .add-btn {
        color: silver;
    }

    .add-btn:hover {
        color: grey;
        cursor: pointer;
    }



    .list-group.list-group-root {
        padding: 0;
        overflow: hidden;
    }

    .list-group.list-group-root .list-group {
        margin-bottom: 0;
    }

    .list-group.list-group-root .list-group-item {
        border-radius: 0;
        border-width: 1px 0 0 0;
    }

    .list-group.list-group-root>.list-group-item:first-child {
        border-top-width: 0;
    }

    .list-group.list-group-root>.list-group>.list-group-item {
        padding-left: 30px;
    }

    .list-group.list-group-root>.list-group>.list-group>.list-group-item {
        padding-left: 45px;
    }
</style>

</html>