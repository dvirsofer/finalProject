<?php

/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 30/04/2016
 * Time: 11:34
 */

require_once('./model/ActivityModel.php');
require_once('./model/WorkerModel.php');
require_once("./view/ActivityView.php");
require_once('./model/ShiftOrganizerModel.php');

/**
 * Class ActivityController
 */
class ActivityController
{
    private $activityModel;
    private $activityView;
    private $workerModel;
    private $shiftOrganizer;

    /**
     * constructor
     */
    public function __construct()
    {
        $this->activityModel = new ActivityModel();
        $this->activityView = new ActivityView();
        $this->workerModel = new WorkerModel();
        $this->shiftOrganizer = new ShiftOrganizerModel();
    }

    /**
     * show activity page.
     */
    public function index()
    {
        $this->activityView->showActivity();
    }

    /**
     * show all activities page.
     */
    public function allActivities()
    {
        $this->activityView->showAllActivities();
    }

    /**
     * show edit activity page.
     */
    public function editActivity()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityId = $_POST['activity_id'];
            $this->activityModel->editActivity($activityId);
        }

    }

    /**
     * edit mobility activity.
     */
    public function editMobilityActivity()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityId = $_POST['activity_id'];
            $activity = $this->activityModel->getActivity($activityId);
            $workerId = $activity[0]->worker_id;
            $customerId = $activity[0]->new_customer_id;
            $this->activityModel->editActivity($activityId);
            $this->workerModel->updateCustomerOfWorker($workerId, $customerId);
            //for update history
            $this->shiftOrganizer->updateHistory($workerId,'Approve');
        }
    }

    /**
     * shoe activity page.
     */
    public function cancelActivity()
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $activityId = $_POST['activity_id'];
            $this->activityModel->updateCancelActivity($activityId);
            //for update history
            $activity = $this->activityModel->getActivity($activityId);
            $workerId = $activity[0]->worker_id;
            $this->shiftOrganizer->updateHistory($workerId,'Cancel');
        }
    }



}