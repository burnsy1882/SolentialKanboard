<?php

require __DIR__ . '/vendor/autoload.php';

use Datto\JsonRpc\Http\Client;
use Datto\JsonRpc\Http\Exceptions\HttpException;
use Datto\JsonRpc\Responses\ErrorResponse;
use ErrorException as err;

if (isset($_POST['title']))
{
    $uri = 'http://localhost/jsonrpc.php';
    $username = 'jsonrpc';
    $password = 'a6a5fa8332f4879826ff525e11e05b3f5dfbaede198703eaf18edd092704';

    $authentication = base64_encode("{$username}:{$password}");
    $headers = ['Authorization' => "Basic {$authentication}"];

    $client = new Client($uri, $headers);
    $client->query('createTask', ['project_id' => 1, 'title' => $_POST['title'], 'description' => $_POST['description']], $result);

    try
    {
        $client->send();
    }
    catch (err $exception)
    {
        print $exception;
        exit(1);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <link type="text/css" href="/assets/css/vendor.min.css" rel="stylesheet">
        <link type="text/css" href="/assets/css/light.min.css" rel="stylesheet">


        <script type="text/javascript" src="/assets/js/vendor.min.js"></script>
        <script type="text/javascript" src="/assets/js/app.min.js"></script>

        <link rel="icon" type="image/png" href="/assets/img/favicon.png">

        <title>Kanboard Quick Add Task</title>
    </head>
    <body>
        <header>
            <div class="title-container">
                <h1>
                    <span class="logo">
                        <a href="/">K<span>B</span></a>
                    </span>
                    <span class="title">
                        Kanboard Quick Add Task
                    </span>
                </h1>
            </div>
        </header>
        <section class="page">
            <?php
                if (isset($result))
                {
                    print('<div class="alert alert-success">Added task successfully.</div>');
                }
                if (isset($exception))
                {
                    print('<div class="alert alert-error">'.$exception.'</div>');
                }
            ?>
            <section class="main">
                <section class="sidebar-container" id="config-section">
                    <div class="sidebar">
                        <ul>
                            <li class="active">New Task</li>
                        </ul>
                    </div>
                    <div class="sidebar-content">
                        <div class="page-header">
                            <h2>New Task</h2>
                        </div>
                        <form method="post">
                            <fieldset>
                                <label for="form-title" class="ui-helper-hidden-accessible">Title</label>
                                <input type="text" name="title" id="form-title" class="" autofocus required tabindex="1" placeholder="Title">
                                <span class="form-required">*</span>

                                <div class="text-editor">
                                    <textarea name="description" id="form-description" tabindex="2" aria-label="Description" placeholder="Write your text in Markdown"></textarea>
                                </div>
                            </fieldset>
                            <div class="form-actions">
                                <button type="submit" class="save-btn btn btn-blue">Save</button>
                            </div>
                        </form>
                    </div>
                </section>
            </section>
        </section>
    </body>
</html>
