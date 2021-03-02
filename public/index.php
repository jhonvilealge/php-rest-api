<?php

header('Content-Type: application/json');

require_once '../vendor/autoload.php';

if (isset($_GET['url'])) {
    $url = explode('/', $_GET['url']);

    if ($url[0] === 'api') {
        array_shift($url);

        try {
            if (!$url) {
                http_response_code(404);
                echo json_encode(array('status' => 404, 'message' => 'Service not found.', 'data' => []));
                exit;
            }

            $service = 'App\Services\\' . ucfirst($url[0]) . 'Service';

            if (class_exists($service)) {
                array_shift($url);

                $method = strtolower($_SERVER['REQUEST_METHOD']);
                $response = call_user_func_array(array(new $service, $method), $url);

                echo json_encode($response);
            } else {
                http_response_code(404);
                echo json_encode(array('status' => 404, 'message' => 'Service not found.', 'data' => []));
            }
        } catch (\Exception $e) {
            echo json_encode(array('status' => $e->getCode(), 'message' => $e->getMessage(), 'data' => []));
        }
    }
}
