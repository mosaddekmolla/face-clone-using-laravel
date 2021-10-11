@php
    $user_id = app\Models\User::where('id', auth()->user()->id)->update([
        'last_login' => now()
    ]);

@endphp


<!DOCTYPE html>
<html>
    <head>
        <title>FaceClone - The Social Network</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="assets/css/style.css"/>
        <link rel="stylesheet" href="assets/css/admin.css"/>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <style>
            .box{
                background: rgba(255,255,255,1);
                padding: 10px 20px;
                border-radius: 2px;
                box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.4);
            }
        </style>
    </head>
    <body><div class="header no-shadow">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo">
                        <h1>FaceClone</h1>
                    </div>
                </div>
                <div class="col-sm-8">
                    <ul class="header-menu pull-right">
                        <li><a href="#" class="">Requests</a></li>
                        <li><a href="#" class="">Messages</a></li>
                        <li><a href="#" class="">Notifications</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>