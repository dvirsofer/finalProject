<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/12/2015
 * Time: 16:39
 */

require_once('./model/WorkerModel.php');
require_once("./view/WorkerView.php");

/**
 * Class Worker
 */
class Worker
{
    private $workerModel;
    private $workerView;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->workerModel = new WorkerModel();
        $this->workerView = new WorkerView();
    }

    /**
     * Show worker page.
     */
    public function index()
    {
        $id = '';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['select_worker'];
        }
        $this->workerView->showWorker($id);
    }

    /**
     * show worker table page.
     */
    public function showWorkersTable()
    {
        $this->workerView->showWorkersTable();
    }

    /**
     * @return string - message.
     */
    public function newWorker()
    {
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $date = $_POST['date'];
        $phone = $_POST['phone_number'];
        $nation = $_POST['nation'];
        $passportNumber = $_POST['passport_number'];
        $validPassport = $_POST['valid_passport'];
        $gender = $_POST['gender'];
        $arrive = $_POST['arrive'];
        $arrivalDate = $_POST['arrival_date'];
        //$exitDate = $_POST['exit_date'];
        $comments = $_POST['comments'];
        $userId = $_POST['user_id'];
        $customerId = $_POST['customer_id'];
        $worker =  $this->workerModel->newWorker($firstName, $lastName, $date, $phone, $nation, $passportNumber, $validPassport, $gender,
            $arrive, $arrivalDate, $comments, $userId, $customerId);
        $workerPassport = $this->workerModel->addPassport($worker, $passportNumber, $validPassport);
        error_log(print_r($workerPassport, TRUE));
        return $worker;
    }

    /**
     * @return bool
     * true - if update success
     * false - else.
     */
    public function updateWorker()
    {
        $workerId = $_POST['worker_id'];
        $worker = $this->workerModel->updateWorker($workerId);
        echo $worker;
    }

    public function editWorker()
    {
        $workerId = $_POST['worker_id'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $date = $_POST['date'];
        $phone = $_POST['phone_number'];
        $nation = $_POST['nation'];
        $passportNumber = $_POST['passport_number'];
        $validPassport = $_POST['valid_passport'];
        $gender = $_POST['gender'];
        $arrive = $_POST['arrive'];
        $arrivalDate = $_POST['arrival_date'];
        $comments = $_POST['comments'];
        $worker = $this->workerModel->editWorker($workerId, $firstName, $lastName, $date, $phone, $nation,
            $passportNumber, $validPassport, $gender, $arrive, $arrivalDate, $comments);

    }

}