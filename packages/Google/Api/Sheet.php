<?php

namespace Google\Api;

class Sheet
{
    /**
     * @var string
     */
    private $url = 'https://docs.google.com/spreadsheets/d/e/<key>/pub?output=csv&gid=<gid>';

    /**
     * @param string $gridId
     * @return array
     * @throws \Exception
     */
    public function getData(string $gridId): array
    {
        $this->url = str_replace('<key>', env('GOOGLE_SHEET_MASTER_DATA'), $this->url);
        $this->url = str_replace('<gid>', $gridId, $this->url);
        $file_handle = fopen($this->url, "r");
        $line_of_text = [];
        while (!feof($file_handle)) {
            $line_of_text[] = fgetcsv($file_handle, 1024);
        }
        unset($line_of_text[0]);
        return $line_of_text;
    }


}