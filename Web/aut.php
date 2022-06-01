<?php include_once "../../itBook/Web/header.php"; ?>


<form method="" action="">
    <div class="container">
        <div class="container mt-3" style="padding-block: 30px">
            <div class="card" style="width:400px;border: solid;">
                <div class="mb-3" style="padding: 10px;">
                    <h3 style="text-align: center">Authorization</h3><br>
                    <img src="../resources/img/key.jpg" style="width: 100px; height: 100px">
                </div>
                <div class="mb-3" style="margin-left: 40px; width: 250px">
                    <input type="email" class="form-control" name="email" id="email" placeholder="E-mail">
                </div>
                <div class="mb-3" style="margin-left: 40px;">
                    <button type="button" class="btn btn-success" name="submit" id="submit" >Вход</button>

                    <div style="display: none" id="message">
                    <h4 style="color: #0d6efd;"> Передитье на почту
                        &#128640; &#128513; </h4>
                    </div>
                </div>
            </div>
        </div>
</form>



<script src="../resources/js/aut.js"></script>




