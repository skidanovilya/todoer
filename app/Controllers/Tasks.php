<?php 

namespace TorjaPHP\Controllers;

use TorjaPHP\Core\Controller;
use TorjaPHP\Models\Task;
use TorjaPHP\Components\Redirect;
use TorjaPHP\Components\Paginator;
use TorjaPHP\Components\Validator;
use TorjaPHP\Components\Flash;
use TorjaPHP\Components\Auth;

class Tasks extends Controller { 
    public function add() {
        $task = $this->model("Task");        

        $data = [
            "title" => "Добавьте новую задачу",
            "form" => [
                "name" => "",
                "email" => "",
                "body" => ""
            ],
            "errors" => []
        ];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data["form"]["name"] = $_POST["name"];
            $data["form"]["email"] = $_POST["email"];
            $data["form"]["body"] = $_POST["body"];
        
            $task->sanitize($data["form"]["name"], $data["form"]["email"], $data["form"]["body"]);

            $task->validate(
                $data["form"]["name"], 
                $data["form"]["email"], 
                $data["form"]["body"],
                $data["errors"]
            );

            if (empty($data["errors"])) {
                $task->post($data["form"]["name"], $data["form"]["email"], $data["form"]["body"]);
            
                Flash::success("Задача успешно добавлена!");

                (new Redirect("/"))->run();
            }
        }

        $this->view("tasks/add", $data);
    }

    public function edit($id) {
        if (!Auth::isAuthorized()) {
            Flash::error("У Вас нет доступа к этому разделу!");

            (new Redirect("/"))->run();
        }

        $validator = new Validator();

        $task = $this->model("Task");

        $id = $validator->sanitize($id);     

        $current = $task->get($id);

        if (!$current) {
            Flash::error("Задачи с ID не существует!");

            (new Redirect("/tasks/add"))->run();
        }

        $data = [
            "title" => "Редактирование задачи",
            "id" => $current->id,
            "form" => [
                "name" => $current->name,
                "email" => $current->email,
                "body" => $current->body,
                "modified" => $current->modified,
            ],
            "errors" => []
        ];

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data["form"]["name"] = $_POST["name"];
            $data["form"]["email"] = $_POST["email"];

            if (strcmp($_POST["body"], $data["form"]["body"])) {
                $data["form"]["modified"] = 1;
            }
            $data["form"]["body"] = $_POST["body"];
        
            $task->sanitize($data["form"]["name"], $data["form"]["email"], $data["form"]["body"]);

            $task->validate(
                $data["form"]["name"], 
                $data["form"]["email"], 
                $data["form"]["body"],
                $data["errors"]
            );

            if (empty($data["errors"])) {
                foreach ($data["form"] as $column => $value) {
                    $task->update($id, $column, $value);
                }
            
                Flash::success("Задача успешно отредактирован!");

                (new Redirect("/"))->run();
            }
        }

        $this->view("tasks/edit", $data);
    }

    public function delete($id) {
        if (!Auth::isAuthorized()) {
            Flash::error("У Вас нет доступа к этому разделу!");

            (new Redirect("/"))->run();
        }

        $validator = new Validator();

        $task = $this->model("Task");

        $id = $validator->sanitize($id);

        $task->delete($id);

        (new Redirect("/"))->run();
    }

    public function complete($id) {
        if (!Auth::isAuthorized()) {
            Flash::error("У Вас нет доступа к этому разделу!");

            (new Redirect("/"))->run();
        }

        $validator = new Validator();

        $task = $this->model("Task");

        $id = $validator->sanitize($id);

        $task->update($id, "complete", 1);

        (new Redirect("/"))->run();
    }


    public function show($id) {
        $validator = new Validator();

        $task = $this->model("Task");

        $id = $validator->sanitize($id);

        $data = [
            "task" => $task->get($id)
        ];

        $this->view("tasks/show", $data);
    }

    public function page($page = NULL) {
        $task = $this->model("Task"); 
        $paginator = new Paginator($task->get(), 3);
 
        $data = [
            "sort" => "name",
            "order" => "asc",
            "tasks" => [],
            "page"  => "",
            "last_page" => ""
        ];

        $sort_params = [
            "sort" => ["name", "email", "complete"],
            "order" => ["asc", "desc"],
        ];

        $validator = new Validator();
        foreach ($sort_params as $key => $options) {
            if (!isset($_GET[$key])) {
                continue;
            }

            $param = $validator->sanitize($_GET[$key], function($v) {
                return \mb_strtolower($v);
            });

            $validator->validate($param, $key, NULL, function($v) use($options) {
                return \in_array($v, $options);
            });

            if (!$validator->getErrors()) {
                $data[$key] = $param;
            }
        }

        switch($data["order"]) {
            case "desc":
                $paginator->sort($data["sort"], Paginator::ORDER_DESC);
            break;
            case "asc":
                $paginator->sort($data["sort"], Paginator::ORDER_ASC);
            break;
        }

        $data["last_page"] = $paginator->getLastPage();
        $page = $task->sanitizePage($page);
        if (!$task->validatePage($page, $data["last_page"])) {
            $page = 1;
        }
        $paginator->paginate($page);
        $data["page"] = $page;

        $data["tasks"] = $paginator->get();

        $this->view("tasks/page", $data);
    }
}