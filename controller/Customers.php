<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 07/12/2015
 * Time: 13:43
 */

require_once('./model/CustomersModel.php');
require_once("./view/CustomersView.php");
require_once('./model/WorkerModel.php');

/**
 * Class Customers
 */
class Customers
{
    private $model;
    private $customersView;
    private $workerModel;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->model = new CustomersModel();
        $this->customersView = new CustomersView();
        $this->workerModel = new WorkerModel();
    }

    /**
     * show customers.
     */
    public function index()
    {
        $id = '';

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            if(isset($_POST['customers_dropdown'])) {
                $id = $_POST['customers_dropdown'];
            }
            else {
                $id = "";
            }
        }
        $this->customersView->showCustomers($id);

    }

    /**
     * show customers table.
     */
    public function showCustomersTable()
    {
        $this->customersView->showCustomersTable();
    }

    /**
     * @return string - message.
     */
    public function newCustomer()
    {
        $customerName = $_POST['customer_name'];
        $customerNameEn = $_POST['customer_name_en'];
        $settlement = $_POST['settlement'];
        $mainCustomer = $_POST['main_customer'];
        $companyNumber = $_POST['company_number'];
        $agent = $_POST['dealer'];
        $msg = $this->model->newCustomer($customerName, $customerNameEn, $settlement, $mainCustomer, $companyNumber, $agent);
        return $msg;
    }

    /**
     * @return bool
     * true - if update success.
     * false - else.
     */
    public function updateCustomer()
    {
        $customerId = $_POST['customer_id'];
        $customerName = $_POST['customer_name'];
        $customerNameEn = $_POST['customer_name_en'];
        $settlement = $_POST['settlement'];
        $mainCustomer = $_POST['main_customer'];
        $companyNumber = $_POST['company_number'];
        $agent = $_POST['dealer'];
        $msg = $this->model->updateCustomer($customerId, $customerName, $customerNameEn, $settlement, $mainCustomer, $companyNumber, $agent);
        return $msg;

    }

    public function addContact()
    {
        $customerId = $_POST['customer_id'];
        $contactName = $_POST['contact_name'];
        $phone = $_POST['phone_number'];
        $fax = $_POST['contact_fax'];
        $contactPosition = $_POST['position'];
        $mail = $_POST['contact_mail'];
        $comment = $_POST['comments'];
        $msg = $this->model->addContact($customerId, $contactName, $phone, $fax, $contactPosition, $mail, $comment);
        return $msg;
    }

}