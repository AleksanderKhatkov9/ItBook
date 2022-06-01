<?php include_once "../../itBook/Web/basic.php"; ?>

<form method="post" action="" enctype="">
    <div class="container mt-3" style="padding-block: 40px">
        <div class="card" style="width:40%; border: solid;">
            <div class="mb-3" style="padding: 20px">
                <h3 style="text-align: center">Add Author</h3>
                <img src="../resources/img/author.jpg" style="margin-left: 30px; width: 100px">
            </div>

            <div class="mb-3" style="margin-left: 30px">
                <label for="fio" class="form-label">Book Author</label>
                <input type="text" class="form-control" name="fio" id="fio" style="width: 300px;" placeholder="Book Author">
            </div>

            <div class="mb-3" style="margin-left: 30px">
                <button type="button" class="btn btn-success" name="submit" id="submit" style="margin-right: 10px">Save</button>
            </div>
        </div>
    </div>
</form>


<script src="../resources/js/addAuthor.js"></script>
