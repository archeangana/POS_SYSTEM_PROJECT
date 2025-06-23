<?php


class ServicesController extends Controller {

    public function indexAction() {
        include './views/services/services.php';
    }

    // public function detailsAction() {
    //     // Logic to fetch service details based on an ID or slug
    //     $serviceId = $_GET['id'] ?? null;
    //     if ($serviceId) {
    //         // Fetch service details from the model (not implemented here)
    //         include './views/services/service_details.php';
    //     } else {
    //         $this->handleError();
    //     }
    // }

}