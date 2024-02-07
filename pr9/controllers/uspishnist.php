<?php
class UspishnistController
{
    public $model;

    public function __construct()
    {
        $this->model = new UspishnistModel;
    }

    public function redirect($url)
    {
        if ($url)
            header('Location: ' . $url);
    }

    public function index()
    {
        $uspishnist = $this->model->getItems();
        $students = $this->model->getStudents();
        $subjects = $this->model->getSubjects();
        include 'views/uspishnist.php';
    }

    public function getData()
    {
        $data['uspishnist'] = $this->model->getItems();
        $data['students'] = $this->model->getStudents();
        $data['subjects'] = $this->model->getSubjects();

        die(json_encode($data));
    }

    public function add()
    {
        if ($_POST) {
            $this->model->add();
        }
        die(json_encode(true));
    }

    public function actions()
    {
        if (isset($_POST['delete']))
            $this->model->delete();
        if ($_POST['update'])
            $this->model->update();
        die(json_encode(true));
    }
}
?>