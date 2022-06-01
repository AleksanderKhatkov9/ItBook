
<?php include_once "../../itBook/Web/header.php"; ?>


<div>
    <form method="post" action="">
        <div class="container mt-3">
            <div class="card" style="width: 400px; border: solid;">
                <div class="mb-3" style="padding: 20px">
                    <h3 style="text-align: center">Registration</h3><br>
                </div>

                <div class="mb-3" style="margin-left: 20px; width: 250px;">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                </div>

                <div class="mb-3" style="margin-left: 20px; width: 250px;">
                    <input type="text" class="form-control" name="login" id="login" placeholder="Login">
                </div>

                <div class="mb-3" style="margin-left: 20px; width: 250px;">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                <div class="mb-3" style="margin-left: 20px; width: 250px;">
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                </div>

                <div class="mb-3" style="margin-left: 20px; width: 250px;">
                    <button type="button" class="btn btn-success" name="submit" id="submit">Save</button>
                </div>
            </div>
    </form>
</div>


<script src="../resources/js/register.js"></script>
