<?php


namespace Siigo;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class Client
{
    const API_TOKEN_URL = "https://siigonube.siigo.com:50050/connect/token";
    const API_BASE_URL = "http://siigoapi.azure-api.net/siigo/api/";
    const API_VERSION = "v1";

    private $namePassword;
    private $user;
    private $password;
    private $staticToken;
    private $subscriptionKey;

    public function __construct($namePassword, $user, $password, $staticToken, $subscriptionKey)
    {

        $this->namePassword = $namePassword;
        $this->user = $user;
        $this->password = $password;
        $this->staticToken = $staticToken;
        $this->subscriptionKey = $subscriptionKey;
    }

    public function client()
    {
        return new GuzzleClient([
            "base_uri" => $this->getBaseUrl()
        ]);
    }

    /**
     * @return string
     */
    public function getUrlToken()
    {
        return self::API_TOKEN_URL;
    }

    public function getBaseUrl()
    {
        return self::API_BASE_URL . self::API_VERSION . '/';
    }

    public function getToken()
    {
        try {
            $client = new GuzzleClient();
            $request = new Request('POST', $this->getUrlToken(), [
                'Authorization' => 'Basic ' . $this->staticToken,
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Accept' => 'application/json'
            ], "grant_type=password&\nusername=$this->namePassword\\$this->user&\npassword=$this->password&\nscope=WebApi offline_access\n");

            $response = $client->send($request);

            return self::responseJson($response);
        }catch (RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAccountGroupsAll()
    {
        try{
            $response = $this->client()->get('AccountGroups/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getAccountGroupByID($id)
    {
        try{
            $response = $this->client()->get("AccountGroups/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function invoice(array $params)
    {
        try{
            $response = $this->client()->post('invoice/Save', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                   'namespace' =>  self::API_VERSION
                ],
                'json' => $params
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function createDeveloper(array $params)
    {
        try{
            $response = $this->client()->post('Developers/Create', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ],
                'json' => $params
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function deleteDeveloper($id)
    {
        try{
            $response = $this->client()->delete("Developers/Delete/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return $response->getStatusCode();
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getDevelopersAll()
    {
        try{
            $response = $this->client()->get('Developers/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getDeveloperByID($id)
    {
        try{
            $response = $this->client()->get("Developers/GetById/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function updateDeveloper(array $params)
    {
        try{
            $response = $this->client()->post('Developers/update', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ],
                'json' => $params
            ]);

            return $response->getStatusCode();
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getERPDocumentTypesAll()
    {
        try{
            $response = $this->client()->get('ERPDocumentTypes/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getPaymentMeansAll()
    {
        try{
            $response = $this->client()->get('PaymentMeans/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getPaymentMeansByID($id)
    {
        try{
            $response = $this->client()->get("PaymentMeans/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductListAll()
    {
        try{
            $response = $this->client()->get('PriceList/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductListByID($id)
    {
        try{
            $response = $this->client()->get("PriceList/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function createProduct(array $params)
    {
        try{
            $response = $this->client()->post('Products/Create', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Content-Type' => 'application/json',
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ],
                'json' => $params
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductsAll()
    {
        try{
            $response = $this->client()->get('Products/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductByID($id)
    {
        try{
            $response = $this->client()->get("Products/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getProductBalance($id)
    {
        try{
            $response = $this->client()->get("Products/GetProductBalance/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getTaxesAll()
    {
        try{
            $response = $this->client()->get('Taxes/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getTaxesByID($id)
    {
        try{
            $response = $this->client()->get("Taxes/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getWarehousesByProductId($id)
    {
        try{
            $response = $this->client()->get("Products/GetWarehousesByProductId/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getUsersAll()
    {
        try{
            $response = $this->client()->get('users/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getUserByID($id)
    {
        try{
            $response = $this->client()->get("users/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getWarehousesAll()
    {
        try{
            $response = $this->client()->get('Warehouses/GetAll', [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION,
                    'numberPage' => '0'
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public function getWarehouseByID($id)
    {
        try{
            $response = $this->client()->get("Warehouses/GetByID/$id", [
                'headers' => [
                    'Authorization' => $this->getToken()->access_token,
                    'Ocp-Apim-Subscription-Key' => $this->subscriptionKey
                ],
                'query' => [
                    'namespace' =>  self::API_VERSION
                ]
            ]);

            return self::responseJson($response);
        }catch(RequestException $exception){
            throw new \Exception($exception->getMessage());
        }
    }

    public static function responseJson($response)
    {
        return \GuzzleHttp\json_decode(
            $response->getBody()->getContents()
        );
    }
}