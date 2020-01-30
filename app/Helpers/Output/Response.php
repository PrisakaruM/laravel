<?php
//app/Helpers/Envato/User.php
namespace App\Helpers\Output;
 
class Response {
    
    public static function json_output($message, $status = 'error', $additional = array())
    {
        $status = empty($status) || !is_string($status) ? 'error' : $status;
        $output = array(
            'status'  => $status,
            'message' => $message,
        );

        if (!empty($additional)) {

            if (array_keys($additional) !== range(0, count($additional) - 1)) {
                $output = array_merge($output, $additional);

            } else {
                $output['payload'] = $additional;

            }
        }

        $output = json_encode($output);

        if (json_last_error()) {
            $output = '{"status": "error", "message": "Unexpected error"}';
        }

        header('Content-Type: application/json');
        header('Content-Length: ' . strlen($output));

        exit ($output);
    }
}