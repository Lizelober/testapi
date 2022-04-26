<?php
try {
    require_once("todo.controller.php");
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = explode('/', $uri);
    $requestType = $_SERVER['REQUEST_METHOD'];
    $body = file_get_contents('php://input');
    $pathCount = count($path);
    require_once "dbconfig.php";
    switch ($requestType) {
        case 'GET':
            $id = $data->id;
            $title = $data->title;
            $description = $data->description;
            $done = $data->done;

            $query = "select * from todolist";
            $result = mysqli_query($conn, $query);
            //var_dump ($result);
            $todos = array();
            while($todo = mysqli_fetch_assoc($result)) {
                //var_dump ($todo);
                if ($data->done) { 
                    //$done = '1';
                    $done = true; 
                } else {
                    //$done = '0';
                    $done = false;
                }
                $todos[] = $todo;
            }
            
            echo json_encode($todos);

            break;
        case 'POST':

            $data = json_decode($body);
            $id = $data->id;
            $title = $data->title;
            $description = $data->description;
            $done = $data->done;
            if ($data->done) {
                $done = 1;
            } else {
                $done = 0;
            }

            $query = "INSERT INTO todolist (id, title, description) VALUES ('" . $id . "', '" . $title . "',  '" . $description . "')";
            echo $query;
            if (mysqli_query($conn, $query) or die("Insert Query Failed")) {
                echo $data;
                echo json_encode(array("message" => "Todo Inserted Successfully", "status" => true));
            } else {
                echo json_encode(array("message" => "Failed ToDo  Not Inserted ", "status" => false));
            }
            break;
        case 'PUT':
            $data = json_decode($body);
            print_r($data);
            $id = $data->id;
            $title = $data->title;
            $description = $data->description;
            $done = $data->done;
            if ($data->done) {
                $done = 1;
            } else {
                $done = 0;
            }

            $query = "UPDATE todolist SET title = '$title', description = '$description', done = $done WHERE id = '$id'";

            echo $query;
            if (mysqli_query($conn, $query) or die("Update Query Failed")) {
                echo $data;
                echo json_encode(array("message" => "Todo Updated Successfully", "status" => true));
            } else {
                echo json_encode(array("message" => "Failed Update  Not Updated ", "status" => false));
            }
            
            // $todo = new Todo($data->id, $data->title, $data->description, $data->done);
            // $controller->update($data->id, $todo);
            break;
        case 'DELETE':
            $data = json_decode($body);
            $id = $data->id;
            $title = $data->title;
            $description = $data->description;
            $done = $data->done;

            $query = "DELETE FROM todolist WHERE id = '$id'";

            echo $query;
            if (mysqli_query($conn, $query) or die("Delete Query Failed")) {
                echo $data;
                echo json_encode(array("message" => "Todo Deleted Successfully", "status" => true));
            } else {
                echo json_encode(array("message" => "Failed Delete  Not Deleted ", "status" => false));
            }
            
            // $controller->delete($data->id);
            break;
        default:
            http_response_code(501);
            die();
            break;
    }
} catch (Throwable $e) {
    error_log($e->getMessage());
    http_response_code(500);
    die();
}
