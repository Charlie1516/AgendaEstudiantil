<?php

class Utils
{

    public static function validate(array $inputs, array $fields): array
    {
        $missingFields = [];

        foreach ($fields as $field => $message) {
            if (!isset($inputs[$field]) || empty(trim($inputs[$field]))) {
                $missingFields[$field] = $message;
            }
        }

        return $missingFields;
    }

    public static function getApi(string $url): ?array
    {
        $result = null;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 1);

        $response = curl_exec($curl);

        if ($response !== false) {
            $result = json_decode($response, true);
        }

        curl_close($curl);

        return $result;
    }

    public static function getMultiApi(array|string $urls): array
    {
        $curls = [];
        if (is_string($urls)) {
            $urls = [$urls];
        }
        $mh = curl_multi_init();
        foreach ($urls as $url) {
            $curl = curl_init();

            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($curl, CURLOPT_HEADER, 0);
            $curls[] = $curl;
            curl_multi_add_handle($mh, $curl);
        }

        do {
            $status = curl_multi_exec($mh, $active);
            if ($active) {
                curl_multi_select($mh);
            }
        } while ($active && $status == CURLM_OK);

        $results = [];
        foreach ($curls as $curlHandle) {
            curl_multi_remove_handle($mh, $curlHandle);
            $response = curl_multi_getcontent($curlHandle);
            if ($response !== false) {
                $results[] = json_decode($response, true);
            }
        }
        curl_multi_close($mh);

        return $results;
    }
}
