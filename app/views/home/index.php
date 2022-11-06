<html>

<head>
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="bd-example">
            <form id="form">
                <input type="hidden" class="form-control" name="user_id" id="user_id">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputFName">First Name</label>
                        <input type="text" class="form-control" name="inputFName" id="inputFName" placeholder="First Name">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputLName">Last Name</label>
                        <input type="text" class="form-control" name="inputLName" id="inputLName" placeholder="Last Name">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="inputRole">Role</label>
                        <select name="inputRole" id="inputRole" class="form-control">
                            <option value="0" selected>Choose Role</option>
                            <?php

                            foreach ($roles as $role) {
                            ?>
                                <option value="<?= $role->id ?>"><?= $role->name ?></option>
                            <?php
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="alert col-6 d-none" role="alert">
                    alert message
                </div>
                <br>
                <button type="submit" class="btn btn-primary" id="save">Save</button>
            </form>
        </div>

        <br>
        <h2>Users</h2>
        <ol class="list-group" id="users">
            <li>Немає користувачів</li>
        </ol>
        <a href="https://roman.matviy.pp.ua">CV Roman Matviy</a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="/js/ajax.js"></script>
</body>

</html>