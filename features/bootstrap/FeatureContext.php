<?php

use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Builds a simple test feature example for the api
 */
class FeatureContext implements Context {
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        $this->bearerToken = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIzIiwianRpIjoiNzAwYTY4ZDI0MjRkYjM1Y2E5NzI2MzNhYTU3ZTgzN2JmMzMwNzYyMWY2YTE4NGE1YjU2OGU3YjIxNGY5ZjQ2Y2I3MjdjNTE5YmIyZGI5ZDUiLCJpYXQiOjE2MDU3NjY2MTQsIm5iZiI6MTYwNTc2NjYxNCwiZXhwIjoxNjM3MzAyNjE0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.BhY5IE1nikYrJdxSJKCahvabio1CYJ5I4iabdE00VcW-swr_3-H6caDyXzbtO8SbzL2uMSRzcqaCwp8YSM9JXG9k2s0q3U5foq0ZPjHL4uWgMhnCAtrCX1jTwKKHSE57oD4e9N7eNEf5R90ZDe4g-uTMR7bwhPIGAf0Ny8BGS6M02dLNVP7Q_xC6xbwhupAfW9z3ZzB62rj82Ha7ZyFqZ1uHd0LahCMM1OjeKuwa0DdB5u9VZ_IxpVYFMnC20C2QgtpfRl5srj1kmJWxyUtYOPRXn4higs3uyryIFaP3X4tWIMG2290Cj9kQdFNTpy_5NTcWou2G2qz6QmDzNuBPO8C7PBqZh3W7cYM6SDACJP9lwXcm4xAzBifQlEj_p3r79KSWRI_7gI6PH74YOJJhPtXdNpsObXC_kOMneGpX7bVWmNaCh81fbC-zgbgEzpygpA7xZZFjhyJb-s2yR-phJfOReajF34hR9x_0XuCbUyFYA7uvWtH0Z8gzZuxTVOtkkrAIRrS07fRwTNyvZ26bVGErYyIqB2m-asD4VaxFDpZgzdUVaLPFMa8miNmPM9EaCqLoR0Qd3oCMimCCGImkOhbqGIh_DUgerV9t5rCzLYGr8oIuppxt8c_IrZK3knT7s9KxUDVqbydh7pOp_hxvlSD-PIDqC4gnT1T4nfybMV4";
    }

    /**
     * @Given I have the payload:
     */
    public function iHaveThePayload( PyStringNode $string ) {
        $this->payload = $string;
    }

    /**
     * @When /^I request "(GET|PUT|POST|DELETE|PATCH) ([^"]*)"$/
     */
    public function iRequest( $httpMethod, $argument1 ) {
        $client             = new GuzzleHttp\Client();
        $this->response     = $client->request(
            $httpMethod,
            'http://127.0.0.1:8000' . $argument1,
            [
                'body'    => $this->payload,
                'headers' => [
                    "Authorization" => "Bearer {$this->bearerToken}",
                    "Content-Type"  => "application/json",
                ],
            ]
        );
        $this->responseBody = $this->response->getBody( true );
    }

    /**
     * @Then /^I get a response$/
     */
    public function iGetAResponse() {
        if ( empty( $this->responseBody ) ) {
            throw new Exception( 'Did not get a response from the API' );
        }
    }

    /**
     * @Given /^the response is JSON$/
     */
    public function theResponseIsJson() {
        $data = json_decode( $this->responseBody );

        if ( empty( $data ) ) {
            throw new Exception( "Response was not JSON\n" . $this->responseBody );
        }
    }

    /**
     * @Then the response contains :arg1 records
     */
    public function theResponseContainsRecords( $arg1 ) {
        $data = json_decode( $this->responseBody );

        return count( $data ) === $arg1;
    }

    /**
     * @Then the question contains a title of :arg1
     */
    public function theQuestionContainsATitleOf($arg1)
    {
        $data = json_decode( $this->responseBody );

        if ( $data->title === $arg1 ) {

        } else {
            throw new PendingException('The title does not match');
        }
    }


}
