<?php

namespace Helper {

    use Exception;

    class Helper
    {
        /**
         * Respond with JSON data.
         *
         * @param mixed $data
         * @param int $httpCode
         */
        public static function respondWithJson($data, int $httpCode)
        {
            http_response_code($httpCode);
            echo json_encode($data);
            exit;
        }

        /**
         * Respond with a success message in JSON format.
         *
         * @param string $message
         * @param int $httpCode
         */
        public static function respondWithSuccessMessage(string $message, int $httpCode)
        {
            self::respondWithJson(['message' => $message], $httpCode);
        }

        /**
         * Respond with an error message in JSON format.
         *
         * @param string $message
         * @param int $httpCode
         */
        public static function respondWithErrorMessage(string $message, int $httpCode)
        {
            self::respondWithJson(['message' => $message], $httpCode);
        }

        /**
         * Handle exceptions and send an error response.
         *
         * @param Exception $exception
         */
        public static function handleException(Exception $exception)
        {
            $statusCode = $exception->getCode() ?: 500; // Default to 500 Internal Server Error
            self::respondWithErrorMessage($exception->getMessage(), $statusCode);
        }

        /**
         * Handle database exceptions and send an error response.
         *
         * @param Exception $exception
         */
        public static function handleDatabaseException(Exception $exception)
        {
            $statusCode = $exception->getCode() ?: 500; // Default to 500 Internal Server Error
            self::respondWithErrorMessage('Database Error: ' . $exception->getMessage(), $statusCode);
        }

        /**
         * Validate the HTTP request method against one or more expected methods.
         *
         * @param string|array $expectedMethods
         * @throws Exception
         */
        public static function validateRequestMethod($expectedMethods)
        {
            $currentMethod = $_SERVER['REQUEST_METHOD'];

            if (is_string($expectedMethods)) {
                $expectedMethods = [$expectedMethods];
            }

            if (!in_array($currentMethod, $expectedMethods)) {
                throw new Exception('Method not allowed', 405);
            }
        }
    }
}
