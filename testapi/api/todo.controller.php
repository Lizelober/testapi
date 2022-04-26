<?php
require_once("todo.class.php");

class TodoController {
    private const PATH = __DIR__."/todo.json";
    private array $todos = [];
    private array $positions = [];

    public function __construct() {

        require_once "dbconfig.php";
//         $content = file_get_contents(self::PATH);
//         if ($content === false) {
//             throw new Exception(self::PATH . " does not exist");
//         }  
//         $dataArray = json_decode($content);
//         if (!json_last_error()) {

//             foreach($dataArray as $data) {
//                 if (isset($data->id) && isset($data->title)) {
//                 $this->todos[] = new Todo($data->id, $data->title, $data->description, $data->done);
//                 $this->positions[] = $data->id;
//                 }
//             }
//  //           print_r($this->positions);
//         }
    }

    public function loadAll() : array {
        return $this->todos;
    }

    public function load(string $id) : Todo | bool {
        foreach($this->todos as $todo) {
            if ($todo->id == $id) {
                return $todo;
            }
        }
        return false;
    }

    public function create(Todo $todo) : bool {
        $this->todos[] = $todo;
        print_r($this->todos);
        return true;
    }

    public function update(string $id, Todo $todo) : bool {
        $position = array_search($id, $this->positions);
        $this->todos[$position] = $todo;
        print_r($this->todos);
        return true;
    }

    // public function delete(string $id) : bool {
    public function delete($id) {
        print_r($this->todos);
        $position = array_search($id, $this->positions);
        unset ($this->todos[$position]);
        $this->todos = array_values($this->todos);
        unset ($this->positions[$position]);
        $this->positions = array_values($this->positions);
        print_r($this->positions);
        print_r($this->todos);
        return true;
    }

    // add any additional functions you need below
   
}