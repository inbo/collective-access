<?php
require_once(__CA_LIB_DIR__ . "/Plugins/IWLPlugInformationService.php");
require_once(__CA_LIB_DIR__ . "/Plugins/InformationService/BaseInformationServicePlugin.php");

global $g_information_service_settings_GBIF;
$g_information_service_settings_GBIF = array();

class WLPlugInformationServiceGBIF extends BaseInformationServicePlugin implements IWLPlugInformationService
{
    private $apiUrl = "https://api.gbif.org/v1/species/suggest";
    public $errors = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function getAvailableSettings()
    {
        return [
            'display_name' => _t('GBIF Species Search'),
            'description' => _t('Search species names in the GBIF Taxonomic Backbone.'),
            'settings' => [
                'api_query' => [
                    'type' => 'textfield',
                    'label' => _t('Query string'),
                    'description' => _t('Species name to query in the GBIF API.'),
                    'required' => true,
                ],
            ],
        ];
    }

    public function lookup($pa_settings, $ps_search, $pa_options = null)
{
    if (empty($ps_search)) {
        $this->errors[] = _t("The search string is empty.");
        return false;
    }

    // Build the request URL
    $url = $this->apiUrl . "?q=" . urlencode($ps_search);

    // Debugging: Log the URL being queried
    error_log("GBIF lookup query: " . $url);

    // Execute API request
    $response = $this->makeHttpRequest($url);

    if ($response) {
        $data = json_decode($response, true);
        
        if (json_last_error() === JSON_ERROR_NONE) {
            // Debugging: Log the API response
            error_log("GBIF API response: " . print_r($data, true));
            
            // Process and format results
            $results = [];
            foreach ($data as $item) {
                $results[] = [
                    'label' => $item['scientificName'] ?? 'Unknown name',
                    'url' => $item['key'] ? "https://www.gbif.org/species/{$item['key']}" : null,
                    'idno' => $item['key'] ?? 'unknown',
                ];
            }

            return ['results' => $results];
        } else {
            $this->errors[] = _t("Failed to decode JSON response: %1", json_last_error_msg());
            return false;
        }
    } else {
        $this->errors[] = _t("Failed to retrieve data from the GBIF API.");
        return false;
    }
}


    public function getExtendedInformation($pa_record, $pa_settings = null)
    {
        $this->errors[] = _t("Extended information not available for GBIF records.");
        return false;
    }

private function makeHttpRequest($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);  // To follow redirects, if any

    $response = curl_exec($ch);

    // Check if there was a cURL error
    if (curl_errno($ch)) {
        $this->errors[] = _t("cURL error: %1", curl_error($ch));
        curl_close($ch);
        return false;
    }

    // Check the HTTP response status code
    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($httpStatus !== 200) {
        $this->errors[] = _t("API request failed with status code: %1", $httpStatus);
        curl_close($ch);
        return false;
    }

    curl_close($ch);
    return $response;
}

    public function &getErrors($ps_source = null)
    {
        return $this->errors;
    }

    /**
     * Custom function to process lookup text for display purposes.
     *
     * @param string $ps_text The original lookup text.
     * @return string The processed display value.
     */
    public function getDisplayValueFromLookupText($ps_text)
    {
        // Simplify the lookup text to a clean, display-friendly value.
        // Example: Remove URLs or unnecessary details if present.
        return preg_replace('/\s*\[.*?\]\s*/', '', $ps_text); // Example regex to remove bracketed text
    }
}
