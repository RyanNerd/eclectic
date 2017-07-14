<?php
declare(strict_types=1);

namespace eclectic\App;

class ResponsePayload
{
    protected $data;

    protected $status = 200;

    public function setData(?array $data): void
    {
        $this->data = $data;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function build(?string $message = ''): array
    {
        $messageResponse = (strlen($message) !==0) ? ['message' => $message] : [];
        $response = array_merge($messageResponse, [
            'status' => $this->status,
            'data' => $this->data,
        ]);
        return $response;
    }
}
