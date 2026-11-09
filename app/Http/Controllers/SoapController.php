<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SoapController extends Controller
{
    /**
     * Menampilkan WSDL untuk layanan CheckClearanceStatus.
     */
    public function wsdl()
    {
        $wsdl = '<?xml version="1.0" encoding="UTF-8"?>
<definitions
    name="SIPUSDelService"
    targetNamespace="http://sipus-del.test/soap"
    xmlns="http://schemas.xmlsoap.org/wsdl/"
    xmlns:soap="http://schemas.xmlsoap.org/wsdl/soap/"
    xmlns:xsd="http://www.w3.org/2001/XMLSchema"
    xmlns:tns="http://sipus-del.test/soap">

    <message name="CheckClearanceStatusRequest">
        <part name="nim_peminjam" type="xsd:string"/>
    </message>

    <message name="CheckClearanceStatusResponse">
        <part name="active_loans" type="xsd:int"/>
    </message>

    <portType name="SIPUSDelPortType">
        <operation name="CheckClearanceStatus">
            <input message="tns:CheckClearanceStatusRequest"/>
            <output message="tns:CheckClearanceStatusResponse"/>
        </operation>
    </portType>

    <binding name="SIPUSDelBinding" type="tns:SIPUSDelPortType">
        <soap:binding style="rpc"
            transport="http://schemas.xmlsoap.org/soap/http"/>
        <operation name="CheckClearanceStatus">
            <soap:operation soapAction="CheckClearanceStatus"/>
            <input>
                <soap:body use="encoded"
                    namespace="http://sipus-del.test/soap"
                    encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
            </input>
            <output>
                <soap:body use="encoded"
                    namespace="http://sipus-del.test/soap"
                    encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"/>
            </output>
        </operation>
    </binding>

    <service name="SIPUSDelService">
        <port name="SIPUSDelPort" binding="tns:SIPUSDelBinding">
            <soap:address location="http://127.0.0.1:8000/soap/sipus"/>
        </port>
    </service>
</definitions>';

        return response($wsdl, 200)
            ->header('Content-Type', 'text/xml; charset=UTF-8');
    }

    /**
     * Memproses permintaan SOAP CheckClearanceStatus.
     */
    public function handle(Request $request)
    {
        $xml = simplexml_load_string($request->getContent());

        if ($xml === false) {
            return response('Invalid SOAP XML', 400)
                ->header('Content-Type', 'text/plain');
        }

        $namespaces = $xml->getNamespaces(true);
        $soapNamespace = $namespaces['soap'] ?? 'http://schemas.xmlsoap.org/soap/envelope/';

        $body = $xml->children($soapNamespace)->Body ?? null;

        if (!$body) {
            return response('Invalid SOAP Envelope', 400)
                ->header('Content-Type', 'text/plain');
        }

        $operation = $body->children()->CheckClearanceStatus ?? null;

        if (!$operation) {
            return response('Invalid SOAP operation', 400)
                ->header('Content-Type', 'text/plain');
        }

        $nim = trim((string) $operation->nim_peminjam);

        if ($nim === '') {
            return response('nim_peminjam is required', 422)
                ->header('Content-Type', 'text/plain');
        }

        $activeLoans = Peminjaman::where('nim_peminjam', $nim)
            ->where('status', 'dipinjam')
            ->count();

        $responseXml = '<?xml version="1.0" encoding="UTF-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <CheckClearanceStatusResponse>
            <active_loans>' . $activeLoans . '</active_loans>
        </CheckClearanceStatusResponse>
    </soap:Body>
</soap:Envelope>';

        return response($responseXml, 200)
            ->header('Content-Type', 'text/xml; charset=UTF-8');
    }
}