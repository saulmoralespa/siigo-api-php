<?php

use Siigo\Client;
use PHPUnit\Framework\TestCase;

class SiigoTest extends TestCase
{

    public $siigo;

    protected function setUp()
    {
        $dotenv = Dotenv\Dotenv::createMutable(__DIR__ . '/../');
        $dotenv->load();

        $user = getenv('USER');
        $namePassword = getenv('NAMEPASSWORD');
        $password = getenv('PASSWORD');
        $staticToken = getenv('STATICTOKEN');
        $subscriptionKey = getenv('SUBSCRIPTION_KEY');

        $this->siigo = new Client($namePassword, $user, $password, $staticToken, $subscriptionKey);
    }

    public function testToken()
    {
        $response = $this->siigo->getToken();
        $this->assertAttributeNotEmpty('access_token', $response);
    }

    public function testGetAccountGroupsAll()
    {
        $response = $this->siigo->getAccountGroupsAll();
        var_dump($response);
    }

    public function testGetAccountGroupByID()
    {
        $id = 455;
        $response = $this->siigo->getAccountGroupByID($id);
        var_dump($response);
    }

    public function testInvoice()
    {
        $params = array (
            'Header' =>
                array (
                    'Id' => 0,
                    'DocCode' => 55882,
                    'Number' => 0,
                    'EmailToSend' => NULL,
                    'DocDate' => '20191009',
                    'MoneyCode' => '',
                    'ExchangeValue' => 0,
                    'DiscountValue' => 0,
                    'ConsumptionTaxTotalValue' => 0,
                    'TaxDiscTotalValue' => 0,
                    'RetVATTotalID' => -1,
                    'RetVATTotalPercentage' => 0,
                    'RetVATTotalValue' => 0,
                    'RetICATotalID' => -1,
                    'RetICATotalValue' => 0,
                    'RetICATotaPercentage' => -1,
                    'TotalValue' => 41190.7,
                    'TotalBase' => 41190.7,
                    'SalesmanIdentification' => 10154165,
                    'Observations' => 'Registro automático API',
                    'Account' =>
                        array (
                            'IsSocialReason' => 1,
                            'FullName' => 'Universidad Nacional de colombia',
                            'FirstName' => '',
                            'LastName' => '',
                            'IdTypeCode' => 31,
                            'Identification' => '899999063',
                            'CheckDigit' => 3,
                            'BranchOffice' => 0,
                            'IsVATCompanyType' => true,
                            'Address' => 'Cr 45',
                            'Phone' =>
                                array (
                                    'Indicative' => 0,
                                    'Number' => '9466474',
                                    'Extention' => 0,
                                ),
                        ),
                    'Contact' =>
                        array (
                            'Code' => 1,
                            'Phone1' =>
                                array (
                                    'Indicative' => 1,
                                    'Number' => 6337150,
                                    'Extention' => 1320,
                                ),
                            'Mobile' =>
                                array (
                                    'Indicative' => 0,
                                    'Number' => 0,
                                    'Extention' => 0,
                                ),
                            'EMail' => 'contacto@prueba.com',
                            'FirstName' => '',
                            'LastName' => '',
                            'IsPrincipal' => true,
                            'Gender' => 1,
                            'BirthDate' => '',
                        ),
                    'CostCenterCode' => '',
                    'SubCostCenterCode' => '',
                ),
            'Items' =>
                array (
                    0 =>
                        array (
                            'ProductCode' => 'Item-1',
                            'Description' => 'Nombre Producto Prueba API',
                            'GrossValue' => 38139.54,
                            'BaseValue' => 38139.54,
                            'Quantity' => 2,
                            'UnitValue' => 19069.77,
                            'DiscountValue' => 0,
                            'DiscountPercentage' => 0,
                            'TaxAddName' => 'IVA 19%',
                            'TaxAddId' => 3440,
                            'TaxAddValue' => 7246.51,
                            'TaxAddPercentage' => 19,
                            'TaxDiscountName' => 'Retefuente 11%',
                            'TaxDiscountId' => 3446,
                            'TaxDiscountValue' => 4195.35,
                            'TaxDiscountPercentage' => 11,
                            'TotalValue' => 41190.7,
                            'ProductSubType' => 0,
                            'TaxAdd2Name' => '',
                            'TaxAdd2Id' => -1,
                            'TaxAdd2Value' => 0,
                            'TaxAdd2Percentage' => 0,
                            'WareHouseCode' => '',
                        ),
                ),
            'Payments' =>
                array (
                    0 =>
                        array (
                            'PaymentMeansCode' => 2035,
                            'Value' => 41190.7,
                            'DueDate' => '',
                            'DueQuote' => 0,
                        ),
                ),
        );
        $response = $this->siigo->invoice($params);
        var_dump($response);
    }

    public function testCreateDeveloper()
    {
        $params = [
            'id' => 0,
            'FirstName' => 'Saul',
            'LastName' => 'Morales',
            'IsActive' => 0
        ];
        $response = $this->siigo->createDeveloper($params);
        var_dump($response);
    }

    public function testDeleteDeveloper()
    {
        $id = 40;
        $response = $this->siigo->deleteDeveloper($id);
        var_dump($response);
    }

    public function testGetdevelopersAll()
    {
        $response = $this->siigo->getDevelopersAll();
        var_dump($response);
    }

    public function testDeveloperByID()
    {
        $id = 40;
        $response = $this->siigo->getDeveloperByID($id);
        var_dump($response);
    }

    public function testUpdateDeveloper()
    {
        $params = [
            'id' => 40,
            'FirstName' => 'Saul',
            'LastName' => 'Morales',
            'IsActive' => 0
        ];
        $response = $this->siigo->updateDeveloper($params);
        var_dump($response);
    }

    public function testERPDocumentTypes()
    {
        $response = $this->siigo->getERPDocumentTypesAll();
        var_dump($response);
    }

    public function testPaymentMeansAll()
    {
        $response = $this->siigo->getPaymentMeansAll();
        var_dump($response);
    }

    public function testPaymentMeansByID()
    {
        $id = 2035;
        $response = $this->siigo->getPaymentMeansByID($id);
        var_dump($response);
    }

    public function testGetProductListAll()
    {
        $response = $this->siigo->getProductListAll();
        var_dump($response);
    }

    public function testGetProductListByID()
    {
        $id = 2763;
        $response = $this->siigo->getProductByID($id);
        var_dump($response);
    }

    public function testCreateProduct()
    {
        $params = array (
            'Id' => 0,
            'Code' => time(), //sku
            'Description' => 'Nombre Producto Prueba API',
            'ReferenceManufactures' => 'Ref_Fabrica',
            'ProductTypeKey' => 'ProductType_Product',
            'MeasureUnit' => '',
            'CodeBars' => '',
            'Comments' => '',
            'TaxAddID' => 10156,
            'TaxDiscID' => 10158,
            'IsIncluded' => true,
            'Cost' => 0,
            'IsInventoryControl' => false,
            'State' => 1,
            'PriceList1' => 19069.77,
            'PriceList2' => NULL,
            'PriceList3' => NULL,
            'PriceList4' => NULL,
            'PriceList5' => NULL,
            'PriceList6' => NULL,
            'PriceList7' => NULL,
            'PriceList8' => NULL,
            'PriceList9' => NULL,
            'PriceList10' => NULL,
            'PriceList11' => NULL,
            'PriceList12' => NULL,
            'Image' => NULL,
            'AccountGroupID' => 455, //getAccountGroupID
            'SubType' => 0,
            'TaxAdd2ID' => 0,
            'TaxImpoValue' => 0,
        );

        $response = $this->siigo->createProduct($params);
        var_dump($response);
    }

    public function testGetProductsAll()
    {
        $response = $this->siigo->getProductsAll();
        var_dump($response);
    }

    public function testGetProductByID()
    {
        $id = 529459;
        $response = $this->siigo->getProductByID($id);
        var_dump($response);
    }

    public function testGetProductBalance()
    {
        $id = 529459;
        $response = $this->siigo->getProductBalance($id);
        var_dump($response);
    }

    public function testTaxesAll()
    {
        $response = $this->siigo->getTaxesAll();
        var_dump($response);
    }

    public function getTaxesByID()
    {
        $id = 24274;
        $response = $this->siigo->getTaxesByID($id);
        var_dump($response);
    }

    public function testGetWarehousesByProductId()
    {
        $id = 529459;
        $response = $this->siigo->getWarehousesByProductId($id);
        var_dump($response);
    }

    public function testGetUsersAll()
    {
        $response = $this->siigo->getUsersAll();
        var_dump($response);
    }

    public function testGetUserByID()
    {
        $id = 2744;
        $response = $this->siigo->getUserByID($id);
        var_dump($response);
    }

    public function testGetWarehousesAll()
    {
        $response = $this->siigo->getWarehousesAll();
        var_dump($response);
    }

    public function testGetWarehouseByID()
    {
        $id = 1306;
        $response = $this->siigo->getWarehouseByID($id);
        var_dump($response);
    }
}