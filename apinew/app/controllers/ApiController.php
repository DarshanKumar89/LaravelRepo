<?php

use \Illuminate\Pagination\Paginator;
/**
 * Class ApiController
 */
class ApiController extends BaseController
{


    const HTTP_OK = 200;
    const HTTP_CREATED = 201;
    const HTTP_NOT_MODIFIED = 304;
    const HTTP_BAD_REQUEST = 400;
    const HTTP_UNAUTHORIZED = 401;
    const HTTP_FORBIDDEN = 403;
    const HTTP_NOT_FOUND = 404;
    const HTTP_INTERNAL_SERVER_ERROR = 500;

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }


    /**
     * @param $data
     * @param array $headers
     * @return mixed
     */
    public function respond($data, $headers = [])
    {
        header('Content-Type: application/json');
        return Response::json($data, $this->getStatusCode(), $headers);
    }

    /**
     * @param $message
     * @return mixed
     */
    public function respondWithError($message,array $errors=[])
    {
        if(count($errors))
        {
            $data = array_merge([
                'object' => 'error',
               // 'error' => [
                    'message' => $message,
                    'status_code' => $this->getStatusCode()
              //  ]
            ],$errors);

            return $this->respond($data);
        }

        return $this->respond([
            'object' => 'error',
          //  'error' => [
                'message' => $message,
                'status_code' => $this->getStatusCode()
         //   ]
        ]);
    }

    /**
     * @param $items
     * @param $data
     * @return mixed
     */
    protected function respondWithPagination(Paginator $items, $data)
    {

        $data = array_merge($data, [
            'paginator' => [
                'total_count' => $items->getTotal(),
                'total_pages' => ceil($items->getTotal() / $items->getPerPage()),
                'current_page' => $items->getCurrentPage(),
                'limit' => $items->getPerPage()
            ]

        ]);
        return $this->respond($data);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotFound($message = 'Not found')
    {
        return $this->setStatusCode(self::HTTP_NOT_FOUND)->respondWithError($message);

    }


    /**
     * @param string $message
     * @param array $errors
     * @return mixed
     */
    public function respondBadRequest($message = 'Bad request',array $errors=[])
    {
        return $this->setStatusCode(self::HTTP_BAD_REQUEST)->respondWithError($message,$errors);

    }


    /**
     * @param string $message
     * @return mixed
     */
    public function respondNotModified($message = 'Not modified')
    {
        return $this->setStatusCode(self::HTTP_OK)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondInternalError($message = 'Internal error')
    {
        return $this->setStatusCode(self::HTTP_INTERNAL_SERVER_ERROR)->respondWithError($message);
    }

    /**
     * @param string $message
     * @return mixed
     */
    public function respondOk($message = 'Ok')
    {
        return $this->setStatusCode(self::HTTP_OK)->respondWithError($message);
    }


    /**
     * @param string $message
     * @return mixed
     */
    public function respondUnauthorizedError($message = 'Ok')
    {
        return $this->setStatusCode(self::HTTP_UNAUTHORIZED)->respondWithError($message);
    }

} 