<?php

include_once ROOT . '/models/RequestModel.php';
include_once ROOT . '/services/PictureService.php';
include_once ROOT . '/services/ValidationService.php';

class RequestController
{
    /**
     * @var PictureService
     */
    private $pictureService;

    /**
     * @var ValidationService
     */
    private $validationService;

    /**
     * @var RequestModel
     */
    private $requestModel;

    public function __construct()
    {
        $this->pictureService = new PictureService();
        $this->validationService = new ValidationService();
        $this->requestModel = new RequestModel();
    }

    /**
     * @param string $name
     * @param string $order
     */
    public function actionTable($name, $order)
    {
        $requests = $this->requestModel->getXML($name, $order);
        include 'views/components/table.php';
    }

    public function actionIndex()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $error = [];
            $post = $_POST;

            if ($_FILES['picture']) {
                $check = $this->pictureService->canUpload($_FILES['picture']);
                if ($check === true) {
                    $picture = $this->pictureService->makeUpload($_FILES['picture']);
                    $post += ['picture' => $picture];
                } else {
                    array_push($error, $check);
                }
            }

            $check = $this->validationService->validationRequire($_POST['fname']);
            if ($check !== true) {
                array_push($error, $check);
            }

            $check = $this->validationService->validationEmail($_POST['email']);
            if ($check !== true) {
                array_push($error, $check);
            }

            $check = $this->validationService->validationPhone($_POST['tel']);
            if ($check !== true) {
                array_push($error, $check);
            }

            if (!count($error)) {
                $this->requestModel->insertXML($post);
            }
        }
        $requests = $this->requestModel->getXML();

        include ROOT . '/views/request/index.php';
    }

    /**
     * @param string $id
     * @return bool
     */
    public function actionDelete($id)
    {
        $this->requestModel->deleteXML($id);

        return true;
    }

}
