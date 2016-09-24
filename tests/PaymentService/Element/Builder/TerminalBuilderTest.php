<?php
use SinglePay\PaymentService\Element\Builder\TerminalBuilder;

/**
 * TerminalBuilderTest
 * @author Mahendra Rai
 */
class TerminalBuilderTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test Terminal object is built for POS client with appropriate settings.
     */
    public function testBuildPOSTerminal()
    {
        $config = array(
            'terminalId' => '001'
        );

        $terminal = TerminalBuilder::buildPOSTerminal($config);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\Terminal', $terminal);
        $this->assertEquals($terminal->TerminalType, 'PointOfSale');
        $this->assertEquals($terminal->CardPresentCode, 'Present');
        $this->assertEquals($terminal->CardholderPresentCode, 'Present');
        $this->assertEquals($terminal->CardInputCode, 'MagstripeRead');
        $this->assertEquals($terminal->TerminalCapabilityCode, 'MagstripeReader');
        $this->assertEquals($terminal->TerminalEnvironmentCode, 'LocalAttended');
        $this->assertEquals($terminal->MotoECICode, 'NotUsed');
        $this->assertEquals($terminal->ConsentCode, 'FaceToFace');
    }

    /**
     * Test Terminal object is built for standard web client with appropriate settings.
     */
    public function testBuildStandardTerminal()
    {
        $config = array(
            'terminalId' => '002'
        );

        $terminal = TerminalBuilder::buildStandardTerminal($config);
        $this->assertInstanceOf('\SinglePay\PaymentService\Element\Express\Type\Terminal', $terminal);
        $this->assertEquals($terminal->TerminalType, 'ECommerce');
        $this->assertEquals($terminal->CardPresentCode, 'UseDefault');
        $this->assertEquals($terminal->CardholderPresentCode, 'ECommerce');
        $this->assertEquals($terminal->CardInputCode, 'ManualKeyed');
        $this->assertEquals($terminal->TerminalCapabilityCode, 'KeyEntered');
        $this->assertEquals($terminal->TerminalEnvironmentCode, 'ECommerce');
        $this->assertEquals($terminal->MotoECICode, 'NonAuthenticatedSecureECommerceTransaction');
        $this->assertEquals($terminal->ConsentCode, 'Internet');
    }
}