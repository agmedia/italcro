<?php

namespace Agmedia\Helpers {
    if (!class_exists(__NAMESPACE__ . '\\Log', false)) {
        class Log
        {
            public static function store($message, $filename = 'store')
            {
                // Parser contract test: deliberately suppress filesystem logs.
            }
        }
    }
}

namespace {
    require_once __DIR__ . '/../storage/vendor/agmedia/api/src/Connection/Soap/Qiqo.php';

    use Agmedia\Api\Connection\Soap\Qiqo;

    function qiqoTransportAssert($condition, $message)
    {
        if (!$condition) {
            throw new RuntimeException($message);
        }
    }

    function qiqoInvokeParse(Qiqo $qiqo, $xml)
    {
        $method = new ReflectionMethod(Qiqo::class, 'parse');
        $method->setAccessible(true);

        return $method->invoke($qiqo, $xml, 'qTest', null);
    }

    $emptyDiffgram = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <qTestResponse xmlns="http://www.qiqo.hr/">
      <qTestResult>
        <diffgr:diffgram xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1" />
      </qTestResult>
    </qTestResponse>
  </soap:Body>
</soap:Envelope>
XML;

    $qiqo = new Qiqo('test-user', 'test-password', 'https://example.invalid/WebQReaderNew.asmx');
    $rows = qiqoInvokeParse($qiqo, $emptyDiffgram);
    $status = $qiqo->getLastFetchResult();

    qiqoTransportAssert($rows === [], 'Empty diffgram must return no rows.');
    qiqoTransportAssert($status['success'] === true, 'Empty diffgram must be a successful fetch.');
    qiqoTransportAssert($status['empty'] === true, 'Empty diffgram must be marked empty.');
    qiqoTransportAssert($status['error'] === null, 'Empty diffgram must not expose a parser error.');

    $malformedDataset = <<<'XML'
<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
  <soap:Body>
    <qTestResponse xmlns="http://www.qiqo.hr/">
      <qTestResult>
        <diffgr:diffgram xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1">
          <Unexpected />
        </diffgr:diffgram>
      </qTestResult>
    </qTestResponse>
  </soap:Body>
</soap:Envelope>
XML;

    $qiqoMalformed = new Qiqo('test-user', 'test-password', 'https://example.invalid/WebQReaderNew.asmx');
    $rows = qiqoInvokeParse($qiqoMalformed, $malformedDataset);
    $status = $qiqoMalformed->getLastFetchResult();

    qiqoTransportAssert($rows === [], 'Malformed dataset must return no rows.');
    qiqoTransportAssert($status['success'] === false, 'Malformed dataset must not be successful.');
    qiqoTransportAssert($status['error'] === 'dataset_missing', 'Malformed dataset must retain a parser error.');

    putenv('QIQO_ALLOW_INSECURE_HTTP');
    $blocked = false;
    try {
        new Qiqo('test-user', 'test-password', 'http://192.0.2.1/WebQReaderNew.asmx');
    } catch (RuntimeException $error) {
        $blocked = strpos($error->getMessage(), 'Insecure Qiqo HTTP transport is disabled') !== false;
    }
    qiqoTransportAssert($blocked, 'Plain HTTP must be fail-closed unless explicitly approved.');

    putenv('QIQO_ALLOW_INSECURE_HTTP=1');
    $approvedHttp = new Qiqo('test-user', 'test-password', 'http://192.0.2.1/WebQReaderNew.asmx');
    qiqoTransportAssert($approvedHttp instanceof Qiqo, 'Explicit HTTP approval must allow construction without making a request.');
    putenv('QIQO_ALLOW_INSECURE_HTTP');

    echo "QIQO transport parser tests passed.\n";
}
